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

// {
//    "rules":[
//       {
//          "field":"id",
//          "value":5,
//          "operator":"$e"
//       },
//       {
//          "field":"name",
//          "value":"George",
//          "operator":"$e"
//       },
//       {
//          "field":"age",
//          "value":20,
//          "operator":"$gt"
//       }
//    ],
//    "combinator":"and"
// }

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