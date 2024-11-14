CREATE DATABASE THLVN4
USE THLVN4

-- Bang KH
CREATE TABLE KhachHang (
    KhachHangID INT PRIMARY KEY IDENTITY,
    Ten VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    MatKhau VARCHAR(255) NOT NULL,
    DiaChi VARCHAR(255),
    SoDienThoai VARCHAR(15)
);

-- Bang SP
CREATE TABLE SanPham (
    SanPhamID INT PRIMARY KEY IDENTITY,
    TenSanPham VARCHAR(100) NOT NULL,
    Gia DECIMAL(10, 2) NOT NULL,
    MoTa TEXT,
    HinhAnh VARCHAR(255),
    SoLuong INT NOT NULL
);

-- Bang DH
CREATE TABLE DonHang (
    DonHangID INT PRIMARY KEY IDENTITY,
    KhachHangID INT,
    NgayDatHang DATETIME DEFAULT CURRENT_TIMESTAMP,
    TongTien DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (KhachHangID) REFERENCES KhachHang(KhachHangID)
);

-- Chi tiet don hang
CREATE TABLE ChiTietDonHang (
    ChiTietID INT PRIMARY KEY IDENTITY,
    DonHangID INT,
    SanPhamID INT,
    SoLuong INT NOT NULL,
    Gia DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (DonHangID) REFERENCES DonHang(DonHangID),
    FOREIGN KEY (SanPhamID) REFERENCES SanPham(SanPhamID)
);

-- Bang NQT
CREATE TABLE NguoiQuanTri (
    NguoiQuanTriID INT PRIMARY KEY IDENTITY,
    Ten VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    MatKhau VARCHAR(255) NOT NULL
);

-- Bang Phan hoi khach hang
CREATE TABLE PhanHoi (
    PhanHoiID INT PRIMARY KEY IDENTITY,
    KhachHangID INT,
    NguoiQuanTriID INT,
    NoiDung TEXT NOT NULL,
    NgayGui DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (KhachHangID) REFERENCES KhachHang(KhachHangID),
    FOREIGN KEY (NguoiQuanTriID) REFERENCES NguoiQuanTri(NguoiQuanTriID)
);

-- Bang quan ly cua nguoi quan tri
CREATE TABLE LichSuHanhDong (
    HanhDongID INT PRIMARY KEY IDENTITY,
    NguoiQuanTriID INT,
    SanPhamID INT NULL,
    DonHangID INT NULL,
    HanhDong VARCHAR(255) NOT NULL,
    ThoiGian DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (NguoiQuanTriID) REFERENCES NguoiQuanTri(NguoiQuanTriID),
    FOREIGN KEY (SanPhamID) REFERENCES SanPham(SanPhamID),
    FOREIGN KEY (DonHangID) REFERENCES DonHang(DonHangID)
);