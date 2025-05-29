function hienthianh(imageId){
    var image0 = document.getElementById('image0');
    image0.style.display = 'none';

    // Hiển thị ảnh tương ứng với màu được chọn
    var image = document.getElementsByClassName('image');
    for(i=0;i<image.length;i++)
    {
        if(image[i].id === imageId)
        {
            image[i].style.display='block';
        }
        else{
            image[i].style.display='none';
        }
    }  
}

function addDotsToNumberString(numberString) {
  var reversedString = numberString.split("").reverse().join("");
  var result = "";

  for (var i = 0; i < reversedString.length; i++) {
      result += reversedString[i];
      if ((i + 1) % 3 === 0 && i + 1 !== reversedString.length) {
          result += ".";
      }
  }

  return result.split("").reverse().join("");
}



$(document).ready(function() {

  $('.chonmau').click(function(){
    $('.chonmau').removeClass('clicked');

    // Thêm class 'clicked' vào phần tử được click
    $(this).addClass('clicked');

    var seletcvl = $(this).find('input[type="radio"]').val();
    $('#tenmau').val(seletcvl);

  })

  $('.chonramrom').click(function() {
    // Loại bỏ class 'clicked' từ tất cả các phần tử
    $('.chonramrom').removeClass('clicked');

    // Thêm class 'clicked' vào phần tử được click
    $(this).addClass('clicked');

    // Lấy giá trị từ radio button
    var selectedValue = $(this).find('input[type="radio"]').val();




    var a = selectedValue.split('-');

// Chuyển đổi các phần tử thành số
var gia = a[0];
var giagoc = a[1];
var ram = parseInt(a[2]);
var rom = parseInt(a[3]);
var slcon = parseInt(a[4]);

var ramcrom = ram+rom;
  
    
    

    var formatgia= addDotsToNumberString(gia);
    var formatgiagoc= addDotsToNumberString(giagoc);

    
      
  
      // Thực hiện xử lý với số currentNumber ở đây
      // Ví dụ: currentNumber *= 2; (nhân đôi giá trị)
  
    // Hiển thị giá trị trong #displayPrice
    $('#displayPrice').val(formatgia +"đ");


// Nếu bạn muốn hiển thị giá trị gốc không có dấu chấm
$('#displayPrice2').val(gia);
$('#displayPrice3').val(formatgiagoc+"đ");




if(slcon>0)
{
  $('#displaytinhtrang').val(" Còn hàng");
  $('#imageLink').attr('src', "images/tich.jpg");

// Hiển thị thẻ `<img>` (nếu ban đầu nó đang bị ẩn)
}
else{
  $('#displaytinhtrang').val(" Hết hàng")
  $('#imageLink').attr('src', "images/x.jpg");

// Hiển thị thẻ `<img>` (nếu ban đầu nó đang bị ẩn)
}



    // Nếu cần thêm xử lý khác, thực hiện ở đây
  });
});


