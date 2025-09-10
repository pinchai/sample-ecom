###Database Structure
```
+ customer
 - name
 - email
 - password
 - address
 - phone.
+ product
 - name
 - price
 - category
 - description
 - stock
 - image
+ payment_method
 - name
 - account_number
 - account_name
+ cart
 - customer_id
 - product_id
 - qty
+ order
 - customer_id
 - datetime
 - payment_method_id
 - status(pending, packaging, on_delivery, complete)
 - remark
+ order_detail
 - order_id
 - product_id
 - price
 - qty
```
# sample-ecom
