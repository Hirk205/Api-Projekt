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
                <td>gọi,thêm,sửa dữ liệu sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanpham</td>
                <td>GET / POST / PUT</td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>gọi môt sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanpham?idsanpham=...</td>
                <td>GET</td>
                <td>điền id của sản phẩm vào ...</td>
            </tr>
            <tr>
                <td>3</td>
                <td>lấy số lượng trang được phân chia</td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanpham?getnumpage=1&&counts=...</td>
                <td>GET</td>
                <td>điền số lượng sản phẩm  một trang hiện thị vào ...</td>
            </tr>
            <tr>
                <td>4</td>
                <td>phân trang </td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanpham?page=...&&counts=...</td>
                <td>GET</td>
                <td>điền phân trang hiện tại và số lượng sản phẩm hiện thị trong một trang lần lượt vào...</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Xóa sản phẩm </td>
                <td>https://myapiwork.000webhostapp.com/api.php/sanpham?delete=1</td>
                <td>PUT</td>
                <td></td>
            </tr>
            <tr>
                <td>6</td>
                <td>gọi,thêm,sửa dữ liệu loai sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loaisp</td>
                <td>GET / POST / PUT</td>
                <td></td>
            </tr>
            <tr>
                <td>7</td>
                <td>gọi 1 loai sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loaisp?idloai=...</td>
                <td>GET</td>
                <td>điền id loại sản phẩm vào ...</td>
            </tr>
            <tr>
                <td>8</td>
                <td>xóa loại sản phẩm</td>
                <td>https://myapiwork.000webhostapp.com/api.php/loaisp?delete=1</td>
                <td>PUT</td>
                <td></td>
            </tr>
            <tr>
                <td>9</td>
                <td>gọi,thêm,sửa dữ liệu user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/user</td>
                <td>GET / POST / PUT</td>
                <td>lưu ý: khi <b>đăng nhập/đăng ký</b> mà data trả về là 0 thì tài khoản <b>đăng nhập/ đăng ký</b> đó <u>không tồn tại(hoặc sai mật khẩu)/ đã tồn tại vui lòng đăng ký tài khoản khác</u></td>
            </tr>
            <tr>
                <td>10</td>
                <td>gọi 1 user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/user?iduser=...</td>
                <td>GET</td>
                <td>điền id user vào ...</td>
            </tr>
            <tr>
                <td>11</td>
                <td>xóa user</td>
                <td>https://myapiwork.000webhostapp.com/api.php/user?delete=1</td>
                <td>PUT</td>
                <td></td>
            </tr>
            <tr>
                <td>12</td>
                <td>gọi,thêm,sửa dữ liệu hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/hoadon</td>
                <td>GET / POST / PUT</td>
                <td></td>
            </tr>
            <tr>
                <td>13</td>
                <td>gọi 1 hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/hoadon?idbill=...</td>
                <td>GET</td>
                <td>điền id hóa đơn vào ...</td>
            </tr>
            <tr>
                <td>14</td>
                <td>xóa hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/hoadon?delete=1</td>
                <td>PUT</td>
                <td></td>
            </tr>
            <tr>
                <td>15</td>
                <td>gọi,thêm dữ liệu chi tiết hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/chitiethoadon?idbill=...</td>
                <td>GET</td>
                <td>điền id hóa đơn muốn xem chi tiết vào ... </td>
            </tr>
            <tr>
                <td>16</td>
                <td>thêm dữ liệu chi tiết hóa đơn</td>
                <td>https://myapiwork.000webhostapp.com/api.php/chitiethoadon</td>
                <td>POST</td>
                <td></td>
            </tr>
        </table>
    </div>
</body>
</html>