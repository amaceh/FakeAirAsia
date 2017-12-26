
-- membuat database
create user tubes identified by tubes;
grant connect to tubes;
grant all privileges to tubes;

-- membuat tabel bandara
create table bandara(
	id_bandara varchar2(10) not null,
	nama_bandara varchar2(50) not null,
	kota varchar2 (30) not null,
	constraint pk_id_bandara primary key (id_bandara)
);

-- memasukan data bandara
   insert into bandara values('bdo-001','Husein Sastranegara','Bandung'); 
   insert into bandara values('hlp-002','Soekarno Hatta','Jakarta');
   insert into bandara values('cgk-003','Ngurahrai','Bali');
   insert into bandara values('jok-004','Adi Sucipto','Balik Papan');
   insert into bandara values('kix-005','Kansai','Banda Aceh');
   insert into bandara values('hkg-006','Hong Kong International','Makassar');
   insert into bandara values('dmk-007','Don Mueang','Medan');
   insert into bandara values('pek-008','Beijing Capital International','Palembang');


-- membuat tabel untuk argo
create table list_argo(
   id_list_argo varchar2(7) primary key not null,
   kota_awal varchar2(10) not null,
   kota_tujuan varchar2(10) not null,
   harga number(20) not null
);

-- memasukan data
   insert into list_argo values('DPSDPN', 'Bali','Balikpapan',390000);
   insert into list_argo values('GGRDPN', 'Bandung','Jakarta',500);


-- membuat tabel jadwal penerbangan
create table jadwal(
   id_jadwal varchar2(25) primary key not null,
   id_list_argo varchar2(7) not null,
   jadwal_berangkat varchar2 (25) not null,
   jadwal_tiba varchar2 (25) not null,
   harga number(20) not null,
   kursi int not null,
   constraint fk_id_list_argo foreign key (id_list_argo) references list_argo(id_list_argo) on delete cascade
);
-- memasukan data untuk jadwal penerbangan
   insert into jadwal values('jdl_bdo-hlp001', 'DPSDPN','12.17', '15.17', 750000, '1');

-- membuat tabel untuk pembayaaran
create table pembayaran(
   id_jasa_pembayaran varchar2(8) not null,
   nama_jasa_pembayaran varchar2(15) not null,
   constraint pk_id_jasa_pembayaran primary key (id_jasa_pembayaran)
);
   
-- memasukan data untuk pembayaran
   insert into pembayaran values('byr-001','Bank BNI');
   insert into pembayaran values('byr-002','Bank BCA');
   insert into pembayaran values('byr-003','Bandara');
   insert into pembayaran values('byr-004','Alfamart');
   insert into pembayaran values('byr-005','Indomaret');

 

-- membuat tabel penumpang
create table penumpang(
   no_ktp varchar2(13) primary key not null,
   nama_penumpang varchar2(30) not null,
   alamat varchar2(50) not null,
   no_tlp varchar2(13) not null,
);


-- membuat tabel tiket
create table tiket(
   id_tiket varchar2(10) not null,
   id_jadwal varchar2(25) not null,
   no_ktp varchar2(13) not null,
   status varchar2(5) not null,
   constraint pk_id_tiket primary key (id_tiket),
   constraint fk_id_penumpang1 foreign key (no_ktp) references penumpang(no_ktp) on delete set null
);

-- membuat tabel bayar
create table bayar(
   id_bayar varchar2(10) not null,
   id_jasa_pembayaran varchar2(8) not null,
   no_ktp varchar2(13) not null, 
   tgl_pesan date not null,
   tgl_bayar date,
   tgl_ambil date,
   status varchar2(15),
   constraint pk_id_bayar primary key(id_bayar),
   constraint fk_id_jasa_pembayaran foreign key (id_jasa_pembayaran) references pembayaran(id_jasa_pembayaran) on delete set null,
   constraint fk_id_pm foreign key (no_ktp) references penumpang(no_ktp) on delete set null
);



create or replace trigger status
after 
   insert on bayar
for each row
begin
   if inserting then
      update bayar set status='Sudah Bayar' where :new.id_bayar= id_bayar;
   end if;
end;
/

create or replace function hargapenerbangan( no_ktp in varchar2, id_jadwal in varchar2)return number is
v_harga number;
v_harga_jenis jadwal.harga%type;
v_kategori penumpang.kategori%type;
begin
   select no_ktp into v_kategori from penumpang where no_ktp = no_ktp;
   select harga into v_harga_jenis from jadwal where id_jadwal=id_jadwal;
      if v_kategori = 'Dewasa' then
         v_harga:= v_harga_jenis;
      end if;
      if v_kategori = 'Anak' then
         v_harga:= v_harga_jenis * 0.5;
      end if;
   return v_harga;
end harga;
/




