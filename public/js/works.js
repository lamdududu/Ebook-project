// document.getElementsByName('categoryCheck').addEventListener('change', function() {
//     // Lấy giá trị của checkbox
//     var checkboxValue = this.checked ? this.value : '';

//     // Gửi yêu cầu AJAX đến máy chủ
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 // Nếu yêu cầu thành công, cập nhật nội dung của container
//                 document.getElementById('categoryFilter').innerHTML = xhr.responseText;
//             } else {
//                 // Xử lý lỗi nếu có
//             }
//         }
//     };
//     xhr.open('GET', '/loc-theloai?checkboxValue=' + checkboxValue, true);
//     xhr.send();
// });