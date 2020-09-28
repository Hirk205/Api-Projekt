<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Hướng dẫn sử dụng API quản lý quần áo</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        
    </style>
</head>

<body>
    <div>
        <h1>Xin chào bên Client, đây là hướng dẫn sử dụng API quản lý quần áo</h1>
        <h2>Mình có tạo một function api_call.php + demo về loại sản phẩm trong file index.php các bạn vô tải về mà dùng :<a target="_blank" rel="noopener noreferrer" href="https://github.com/Hirk205/Api-Projekt.git">Link Git</a></h2>
        <b></b><h2>Vì cái web host phổ biến nhưng phải trả tiền mới dùng được 2 method PUT và DELETE nên đã viết api chỉ dùng theo POST/GET</h2></b>
        <h3>Đây là một sô url để tương tác với database của API các bạn chỉ cần copy paste vô xài như trong demo là được</h3>
        <table>
            <tr>
                <th>STT</th>
                <th>Chức năng</th>
                <th>URL</th>
                <th>Method</th>
                <th>Lưu ý</th>
            </tr>
            <tr>
                <td>1</td>
                <td>gọi tất cả dữ liệu sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>gọi sản phẩm có tên gọi</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams/show-ten-loai</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td>gọi một sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams/{idsanpham}</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td>lấy số lượng phân trang </td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanpham?limit={số lượng sản phẩm hiển thị một trang}</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>5</td>
                <td>hiển thị phân trang </td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanpham?limit={số lượng sản phẩm hiển thị một trang}&&page={trang hiện tại}</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>6</td>
                <td>search sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams?q={keyword}</td>
                <td>GET</td>
                <td>kiếm nhiều sản phẩm hơn keyword1+keyword2, keyword dựa trên idsanpham và tensp</td>
            </tr>
            <tr>
                <td>7</td>
                <td>sắp xếp theo trường</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams?sort={ + hoặc - (trường) }</td>
                <td>GET</td>
                <td>+ nếu tăng / - nếu giảm</td>
            </tr>
            <tr>
                <td>8</td>
                <td>chọn 1 sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams/{idsanpham}</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>9</td>
                <td>chọn 1 sản phẩm hiển thị tên loại</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams/{idsanpham}/show-ten-loai</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>10</td>
                <td>chọn trường hiển thị</td>
                <td><p>https://myapiwork.000webhostapp.com/api.php/sanphams?fields={những trường muôn hiển thị ra}</p>
                    <p>https://myapiwork.000webhostapp.com/api.php/sanphams/show-ten-loai?fields={những trường muôn hiển thị ra}</p>
                    <p>https://myapiwork.000webhostapp.com/api.php/sanphams/{idsanpham}?fields={những trường muôn hiển thị ra}</p>
                    <p>https://myapiwork.000webhostapp.com/api.php/sanphams/{idsanpham}/show-ten-loai?fields={những trường muôn hiển thị ra}</p></td>
                <td>GET</td>
                <td>những trường được cho phép hiển thị ra: idsanpham, loaisp, mau, size, thuonghieu, giagoc, dongia, mota, hinhanh 
                    với nhũng URL có thêm <b>show-ten-loai</b> thì thêm trường tenloai</td>
            </tr>
            <tr>
                <td>11</td>
                <td>xóa sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams/{idsanpham}/delete</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>12</td>
                <td>thêm sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams</td>
                <td>POST</td>
                <td></td>
            </tr>
            <tr>
                <td>13</td>
                <td>sửa sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanphams/{idsanpham}</td>
                <td>POST</td>
                <td></td>
            </tr>
            <tr>
                <td>14</td>
                <td>lấy dữ liệu loại sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loaisps</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>15</td>
                <td>lấy dữ liệu 1 loại sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loaisps/{idloai}</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>15</td>
                <td>lấy dữ liệu tất cả sản phẩm có loại sản phẩm nhất định</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loaisps/{idloai}/sanphams</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>16</td>
                <td>chọn trường hiển thị</td>
                <td><p>https://myapiwork.000webhostapp.com/api.php/loaisps?fields={những trường muôn hiển thị ra}</p>
                    <p>https://myapiwork.000webhostapp.com/api.php/loaisps/{idloai}/sanphams?fields={những trường muôn hiển thị ra}</p></td>
                <td>GET</td>
                <td>những trường được cho phép hiển thị ra: loaisp,idloai
                    với nhũng URL có thêm <b>show-ten-loai</b> thì thêm trường idsanpham,mau, size, thuonghieu, giagoc, dongia, mota, hinhanh </td>
            </tr>
            <tr>
                <td>17</td>
                <td>xóa 1 loại sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loasips/{idloai}/delete</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>18</td>
                <td>thêm 1 loại sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loasips</td>
                <td>POST</td>
                <td></td>
            </tr>
            <tr>
                <td>19</td>
                <td>sửa 1 loại sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loasips/{idloai}</td>
                <td>POST</td>
                <td></td>
            </tr>
            <tr>
                <td>20</td>
                <td>lấy tất cả dữ liệu của user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/users</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>21</td>
                <td>lấy  dữ liệu của 1 user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/users/{iduser}</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>22</td>
                <td>lấy  dữ liệu của hóa đơn theo một user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/users/{iduser}/hoadons</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>23</td>
                <td>chọn trường hiển thị</td>
                <td><p>https://myapiwork.000webhostapp.com/api.php/users?fields={những trường muôn hiển thị ra}</p>
                    <p>https://myapiwork.000webhostapp.com/api.php/users/{iduser}?fields={những trường muôn hiển thị ra}</p>
                    <p>https://myapiwork.000webhostapp.com/api.php/users/{iduser}/hoadons?fields={những trường muôn hiển thị ra}</p>
                </td>
                <td>GET</td>
                <td>những trường được cho phép hiển thị ra: iduser, username, password,phone,address,dob,level
                    với nhũng URL có thêm <b>hoadons</b> thì <b>chỉ có</b> các trường username,idbill,noigiao, ngaydathang, tongtien, giagoc, dongia, mota, hinhanh </td>
            </tr>
            <tr>
                <td>24</td>
                <td>xóa user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/users/{iduser}/delete</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>25</td>
                <td>thêm(đăng ký) user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/users</td>
                <td>POST</td>
                <td></td>
            </tr>
            <tr>
                <td>26</td>
                <td>đăng nhập user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/users?action=login</td>
                <td>POST</td>
                <td></td>
            </tr>
            <tr>
                <td>27</td>
                <td>thăng/hạ chức vụ user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/users/{iduser}?action=promote/demote</td>
                <td>POST</td>
                <td></td>
            </tr>
            <tr>
                <td>28</td>
                <td>sửa địa chỉ và số điện thoại user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/users/{iduser}</td>
                <td>POST</td>
                <td></td>
            </tr>
            <tr>
                <td>29</td>
                <td>lấy tất cả hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/hoadons</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>30</td>
                <td>lấy 1 hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/hoadons/{idbill}</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>31</td>
                <td>lấy chi tiết hóa đơn theo id hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/hoadons/{idbill}/chitiethoadon</td>
                <td>GET</td>
                <td></td>
            </tr>
            <tr>
                <td>32</td>
                <td>chọn trường hiển thị</td>
                <td><p>https://myapiwork.000webhostapp.com/api.php/hoadons?fields={những trường muôn hiển thị ra}</p>
                    <p>https://myapiwork.000webhostapp.com/api.php/hoadons/{idbill}?fields={những trường muôn hiển thị ra}</p>
                    <p>https://myapiwork.000webhostapp.com/api.php/hoadons/{idbill}/chitiethoadon?fields={những trường muôn hiển thị ra}</p>
                </td>
                <td>GET</td>
                <td>những trường được cho phép hiển thị ra: idbill,iduser,noigiao,ngaydathang,tongtien
                    với nhũng URL có thêm <b>hoadons</b> thì <b>chỉ có</b> các trường idbill,iduser,noigiao,ngaydathang,tongtien,idsanpham,soluong,dongia,thanhtien </td>
            </tr>
            <tr>
                <td>31</td>
                <td>xóa hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/hoadons/{idbill}/delete</td>
                <td>GET</td>
                <td>khi xóa sẽ xóa luôn chi tiết hóa đơn</td>
            </tr>
            <tr>
                <td>32</td>
                <td>thêm hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/hoadons</td>
                <td>POST</td>
                <td>thêm hóa đơn cùng với chi tiết hóa đơn</td>
            </tr>
            <tr>
                <td>33</td>
                <td>xem chi tiet hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/chitiethoadons</td>
                <td>GET</td>
                <td></td>
            </tr>
        </table>
    </div>
</body>
</html>