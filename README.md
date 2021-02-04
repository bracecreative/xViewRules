A class for composing base64-encoded JSON for X-View queries:

```php
xViewRules('id', 5)->toJSON();

// {
//    "rules":[
//       {
//          "field":"id",
//          "value":5,
//          "operator":"$e"
//       }
//    ],
//    "combinator":"and"
// } 

xViewRules('id', 5)->and('name', 'George')->and('age', 20, '$gt')->toJSON();

// eyJydWxlcyI6W3siZmllbGQiOiJpZCIsInZhbHVlIjo1LCJvcGVyYXRvciI6IiRlIn0seyJmaWVsZCI6Im5hbWUiLCJ2YWx1ZSI6Ikdlb3JnZSIsIm9wZXJhdG9yIjoiJGUifSx7ImZpZWxkIjoiYWdlIiwidmFsdWUiOjIwLCJvcGVyYXRvciI6IiRndCJ9XSwiY29tYmluYXRvciI6ImFuZCJ9

xViewRules('id', 5)->or(xViewRules('firstName', 'George')->and('lastName', 'Batt'))->toJSON();

// {
//    "rules":[
//       {
//          "field":"id",
//          "value":5,
//          "operator":"$e"
//       },
//       {
//          "rules":[
//             {
//                "field":"firstName",
//                "value":"George",
//                "operator":"$e"
//             },
//             {
//                "field":"lastName",
//                "value":"Batt",
//                "operator":"$e"
//             }
//          ],
//          "combinator":"and"
//       }
//    ],
//    "combinator":"or"
// }

xViewRules('id', 5)->and(xViewRules('firstName', 'George')->or('lastName', 'Batt'))->toJSON();

// {
//    "rules":[
//       {
//          "field":"id",
//          "value":5,
//          "operator":"$e"
//       },
//       {
//          "rules":[
//             {
//                "field":"firstName",
//                "value":"George",
//                "operator":"$e"
//             },
//             {
//                "field":"lastName",
//                "value":"Batt",
//                "operator":"$e"
//             }
//          ],
//          "combinator":"or"
//       }
//    ],
//    "combinator":"and"
// }
```