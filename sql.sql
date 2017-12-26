
create user tubes identified by tubes;
grant connect to tubes;
grant all privileges to tubes;
connect tubes
tubes

create table bandara(
	id_bandara varchar2(10) not null,
	nama_bandara varchar2(50) not null,
	kota varchar2 (30) not null,
	constraint pk_id_bandara primary key (id_bandara)
);

   insert into bandara values('bdo-001','Husein Sastranegara','Bandung'); 
   insert into bandara values('hlp-002','Soekarno Hatta','Jakarta');
   insert into bandara values('cgk-003','I Gusti Ngurahrai','Bali');
   insert into bandara values('jok-004','Sultan Aji M. Sulaiman','Balikpapan');
   insert into bandara values('kix-005','Sultan Iskandar Muda','Banda Aceh');
   insert into bandara values('hkg-006','Sultan Hasanuddin','Makassar');
   insert into bandara values('dmk-007','Kualanamu','Medan');
   insert into bandara values('pek-008','Sultan Mahmud Badaruddin','Palembang');
   

create table list_tarif(
   id_list_tarif varchar2(7) primary key not null,
   kota_awal varchar2(10) not null,
   kota_tujuan varchar2(10) not null,
   harga number(20) not null
);

   insert into list_tarif values('DPSDPN', 'Bali','Balikpapan', 390000);
   insert into list_tarif values('GGRDPN', 'Bandung','Jakarta', 500000);
   insert into list_tarif values('GGRSBY', 'Bandung','Surabaya', 490000);
   insert into list_tarif values('JOKKIX', 'Balikpapan','Banda Aceh', 980000);
   insert into list_tarif values('MKSMDN', 'Makassar','Medan', 340000);
   insert into list_tarif values('MDNBDG', 'Medan','Bandung', 290000);
   insert into list_tarif values('PLBJKT', 'Palembang','Jakarta', 900000);


create table jadwal(
   id_jadwal varchar2(25) primary key not null,
   id_list_tarif varchar2(7) not null,
   jadwal_berangkat varchar2 (25) not null,
   jadwal_tiba varchar2 (25) not null,
   tanggal date not null,
   kursi int not null,
   constraint fk_id_list_tarif foreign key (id_list_tarif) references list_tarif(id_list_tarif) on delete cascade
);
   -- bandara 1
   --180
   insert into jadwal values('jdl_bdo-hlp001', 'DPSDPN','12.17', '15.17', sysdate, '1');
   insert into jadwal values('jd2_bdo-hlp002', 'GGRDPN','15.17', '20.37', '30-DEC-16', '1');
   insert into jadwal values('jd3_bdo-hlp003', 'GGRSBY','10.17', '16.39', '31-DEC-16', '1');
   insert into jadwal values('jd4_bdo-hlp004', 'JOKKIX','11.03', '15.08', '30-DEC-16', '1');
   insert into jadwal values('jd5_bdo-hlp005', 'MKSMDN','14.00', '18.73', '28-DEC-16', '1');
   insert into jadwal values('jd6_bdo-hlp006', 'MDNBDG','15.20', '17.52', '22-DEC-16', '1');
   insert into jadwal values('jd7_bdo-hlp007', 'PLBJKT','16.16', '20.55', '20-DEC-16', '1');


create table penumpang(
   no_ktp varchar2(13) primary key not null,
   nama_penumpang varchar2(30) not null,
   alamat varchar2(50) not null,
   no_tlp varchar2(13) not null
);
 

create table tiket(
   id_tiket int not null,
   id_jadwal varchar2(25) not null,
   no_kursi varchar2(10) not null,
   no_ktp varchar2(13) not null,
   status varchar2(5) not null,
   total_bayar number not null,
   constraint pk_id_tiket primary key (id_tiket),
   constraint fk_id_penumpang1 foreign key (no_ktp) references penumpang(no_ktp) on delete set null
);
create sequence seq_id_tiket increment by 1;

create table bayar(
   id_bayar int not null,
   no_ktp varchar2(13) not null,
   id_tiket int not null,
   tgl_bayar date not null,
   constraint pk_id_bayar primary key(id_bayar),
   constraint fk_id_pm foreign key (no_ktp) references penumpang(no_ktp) on delete set null,
   constraint fk_id_tiket foreign key (id_tiket) references tiket(id_tiket) on delete set null
);
--nentuin harga
create sequence seq_id_bayar increment by 1;


create table pegawai(
   username varchar2(10) primary key,
   nama varchar2(30) not null,
   password varchar2(30) not null
);

insert into pegawai values('admin', 'Super Admin', 'limited.ar34');
insert into pegawai values('kasir1', 'Khamal', 'kasirbarokah');
insert into pegawai values('kasir2', 'Endah', 'sakinahmawaddah');


create or replace procedure harga(id in int, v_kategori in varchar2) as
begin
   if v_kategori = 'Reguler' then
      update tiket set total_bayar=total_bayar+200000 where id_tiket=id;
   end if;
   if v_kategori = 'Max' then
      update tiket set total_bayar=total_bayar+400000 where id_tiket=id;
   end if;
end harga;
/

create or replace trigger kursi
after
   insert or delete or update on tiket
for each row
begin
   if inserting then
      update jadwal set kursi = kursi+1 where id_list_tarif = :new.id_jadwal;
   elsif deleting then
      update jadwal set kursi = kursi-1 where id_list_tarif = :old.id_jadwal;
   end if;
end;
/

create or replace trigger gantistatus
after 
   insert on bayar
for each row
begin
   if inserting then
      update tiket set status='1' where :new.id_tiket = id_tiket;
   end if;
end;
/
