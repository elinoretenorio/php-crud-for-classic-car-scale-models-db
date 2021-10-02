curl -X GET "localhost:8080/customers"

curl -X POST "localhost:8080/customers" -H 'Content-Type: application/json' -d'
{
  "address_line1": "make",
  "address_line2": "office",
  "city": "class",
  "contact_first_name": "gas",
  "contact_last_name": "already",
  "country": "whose",
  "credit_limit": 72.997087122,
  "customer_name": "evidence",
  "employee_number": 147,
  "phone": "prove",
  "postal_code": "sense",
  "state": "religious"
}
'

curl -X POST "localhost:8080/customers/1121" -H 'Content-Type: application/json' -d'
{
  "address_line1": "make",
  "address_line2": "office",
  "city": "class",
  "contact_first_name": "gas",
  "contact_last_name": "already",
  "country": "whose",
  "credit_limit": 72.997087122,
  "customer_name": "evidence",
  "customer_number": 1121,
  "employee_number": 147,
  "phone": "prove",
  "postal_code": "sense",
  "state": "religious"
}
'

curl -X GET "localhost:8080/customers/1121"

curl -X DELETE "localhost:8080/customers/1121"

# --

curl -X GET "localhost:8080/employees"

curl -X POST "localhost:8080/employees" -H 'Content-Type: application/json' -d'
{
  "email": "diana63@example.com",
  "extension": "similar",
  "first_name": "loss",
  "job_title": "ability",
  "last_name": "off",
  "office_code": "administration",
  "reports_to": 2240
}
'

curl -X POST "localhost:8080/employees/3545" -H 'Content-Type: application/json' -d'
{
  "email": "diana63@example.com",
  "employee_number": 3545,
  "extension": "similar",
  "first_name": "loss",
  "job_title": "ability",
  "last_name": "off",
  "office_code": "administration",
  "reports_to": 2240
}
'

curl -X GET "localhost:8080/employees/3545"

curl -X DELETE "localhost:8080/employees/3545"

# --

curl -X GET "localhost:8080/offices"

curl -X POST "localhost:8080/offices" -H 'Content-Type: application/json' -d'
{
  "address_line1": "partner",
  "address_line2": "various",
  "city": "one",
  "country": "wind",
  "office_code": "room",
  "phone": "matter",
  "postal_code": "hear",
  "state": "oil",
  "territory": "put"
}
'

curl -X POST "localhost:8080/offices/1841" -H 'Content-Type: application/json' -d'
{
  "address_line1": "partner",
  "address_line2": "various",
  "city": "one",
  "country": "wind",
  "office_code": "room",
  "office_number": 1841,
  "phone": "matter",
  "postal_code": "hear",
  "state": "oil",
  "territory": "put"
}
'

curl -X GET "localhost:8080/offices/1841"

curl -X DELETE "localhost:8080/offices/1841"

# --

curl -X GET "localhost:8080/order-details"

curl -X POST "localhost:8080/order-details" -H 'Content-Type: application/json' -d'
{
  "order_line_number": 5,
  "order_number": 28,
  "price_each": 916.696878,
  "product_code": "collection",
  "quantity_ordered": 4771
}
'

curl -X POST "localhost:8080/order-details/1942" -H 'Content-Type: application/json' -d'
{
  "order_detail_number": 1942,
  "order_line_number": 5,
  "order_number": 28,
  "price_each": 916.696878,
  "product_code": "collection",
  "quantity_ordered": 4771
}
'

curl -X GET "localhost:8080/order-details/1942"

curl -X DELETE "localhost:8080/order-details/1942"

# --

curl -X GET "localhost:8080/orders"

curl -X POST "localhost:8080/orders" -H 'Content-Type: application/json' -d'
{
  "comments": "Level body then hold. Attorney science door local become.",
  "customer_number": 4691,
  "order_date": "2021-09-28",
  "required_date": "2021-09-30",
  "shipped_date": "2021-09-22",
  "status": "me"
}
'

curl -X POST "localhost:8080/orders/9070" -H 'Content-Type: application/json' -d'
{
  "comments": "Level body then hold. Attorney science door local become.",
  "customer_number": 4691,
  "order_date": "2021-09-28",
  "order_number": 9070,
  "required_date": "2021-09-30",
  "shipped_date": "2021-09-22",
  "status": "me"
}
'

curl -X GET "localhost:8080/orders/9070"

curl -X DELETE "localhost:8080/orders/9070"

# --

curl -X GET "localhost:8080/payments"

curl -X POST "localhost:8080/payments" -H 'Content-Type: application/json' -d'
{
  "amount": 102.0,
  "check_number": "create",
  "customer_number": 8265,
  "payment_date": "2021-09-21"
}
'

curl -X POST "localhost:8080/payments/2111" -H 'Content-Type: application/json' -d'
{
  "amount": 102.0,
  "check_number": "create",
  "customer_number": 8265,
  "payment_date": "2021-09-21",
  "payment_number": 2111
}
'

curl -X GET "localhost:8080/payments/2111"

curl -X DELETE "localhost:8080/payments/2111"

# --

curl -X GET "localhost:8080/product-lines"

curl -X POST "localhost:8080/product-lines" -H 'Content-Type: application/json' -d'
{
  "html_description": "Wind food claim million recently his hair. Policy receive have note. Service stop true I enjoy argue sound.",
  "image": "Responsibility little room simply sing however her.",
  "product_line": "think",
  "text_description": "finally"
}
'

curl -X POST "localhost:8080/product-lines/5196" -H 'Content-Type: application/json' -d'
{
  "html_description": "Wind food claim million recently his hair. Policy receive have note. Service stop true I enjoy argue sound.",
  "image": "Responsibility little room simply sing however her.",
  "product_line": "think",
  "product_line_number": 5196,
  "text_description": "finally"
}
'

curl -X GET "localhost:8080/product-lines/5196"

curl -X DELETE "localhost:8080/product-lines/5196"

# --

curl -X GET "localhost:8080/products"

curl -X POST "localhost:8080/products" -H 'Content-Type: application/json' -d'
{
  "buy_price": 551.27,
  "msrp": 490.35,
  "product_code": "well",
  "product_description": "Only service now human attention house myself. Indeed grow director prevent kid. Yourself many rather stand tonight opportunity effort.",
  "product_line": "production",
  "product_name": "audience",
  "product_scale": "from",
  "product_vendor": "personal",
  "quantity_in_stock": 6889
}
'

curl -X POST "localhost:8080/products/9261" -H 'Content-Type: application/json' -d'
{
  "buy_price": 551.27,
  "msrp": 490.35,
  "product_code": "well",
  "product_description": "Only service now human attention house myself. Indeed grow director prevent kid. Yourself many rather stand tonight opportunity effort.",
  "product_line": "production",
  "product_name": "audience",
  "product_number": 9261,
  "product_scale": "from",
  "product_vendor": "personal",
  "quantity_in_stock": 6889
}
'

curl -X GET "localhost:8080/products/9261"

curl -X DELETE "localhost:8080/products/9261"

# --

