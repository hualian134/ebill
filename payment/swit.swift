let paymentToken: String = "roZG9I1hk/GYjNt+BYPYbxQtKElbZDs9M5cXuEbE+Z0QTr/yUcl1oG7t0AGoOJlBhzeyBtf5mQi1UqGbjC66E85S4m63CfV/awwNbbLbkxsvfgzn0KSv7JzH3gcs/OIL"
let paymentCode: PaymentCode = PaymentCode(channelCode: "KPY")
 
let paymentRequest: PaymentRequest = DigitalPaymentBuilder(paymentCode: paymentCode)
                                     .name("DavidBilly")
                                     .email("davidbilly@2c2p.com")
                                     .accountNo("0070000001")
                                     .build()