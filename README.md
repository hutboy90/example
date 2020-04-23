Vì đề mở nên e update lại bài toán 1 chút:
Khi tạo một order thì client sẽ truyền:
```
{
	"date": 3,
	"fruits" : {"1": 2, "3":3}
}
```

trong đó `fruits` là 1 danh sách các phần tử có dạng: `product_id: amount`

Hiện tại chỉ có 2 sản phẩm: Mango(id=1), và Orange(id=2)

# Tạo order
Url: https://wegiamcan.com/order

Method: Post

Request params:
```
date: integer required(từ 1-365)
fruits: json required
```

*Chú ý*: với 2 trường product_id và amount trong `fruits`
+ product_id phải tồn tại trong database
+ chú ý amount nằm trong khoảng 0-100. E quy định kích thước sản phẩm lớn nhất là 100kg
Ví dụ:
```
{
	"date": 3,
	"fruits" : {"1": 1, "2":2}
}
```

# Get report
Url: http://vinbdi.local/report

Method: Get

Request params:
```
	from: integer optional (mặc định là 0)
	to: integer optional (mặc định là 365)
```

*Chú ý*: from và to nằm trong đoạn [1-365]

# Unit test
Nằm ở đây: https://github.com/hutboy90/example/tree/master/tests

Function get report chưa đầy đủ cases 
