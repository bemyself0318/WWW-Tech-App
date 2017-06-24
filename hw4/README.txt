(a).
姓名: 李政勳
學號: 403410035
網址:http://dmplus.cs.ccu.edu.tw/~s403410035/hw4/main.php

(b).How to implement the AJAX.
在answer.js中使用jquery 抓取前端使用者所輸入的資料並檢查
之後呼叫queryTrainstation 其中使用了jquery的POST :
$.post("目的檔案",要傳的資料,function(回傳的資料){}, "json")
把搜尋範圍傳給result.php去資料庫進行查詢 ，之後得到回傳資料

(c) List the file where JSON format are used.
1.answer.js
2.result.php

(d) Write your JSON structure
{
	"length":the number of train stations,
	"landmarkna":
	{	
		"type" : "FeatureCollection",
		"features" : 
		[
			{
				"type" : "Feature",
				"properties": {
					"landmarkna": "train station name",
					"address": "train station address",
					"distance": "train station distance"
				},
				"geometry":
				{
					"type": "Point",
					"coordinates": [ longitude,latitude ]
				}
			},
			{
				"type" : "Feature",
					"properties": {
						"landmarkna": "train station name",
						"address": "train station address",
						"distance": "train station distance"
					},
					"geometry":
					{
						"type": "Point",
						"coordinates": [ longitude,latitude ]
					}
			}
		]
	}
}

其他:
1.showTrainstationPoint 的功能沒做出來 還在想

2.交作業的要求:
Write your file under your folder.
Go to /home/student/YOUR LOGIN NAME/apache2/htdocs/
不太懂這是甚麼意思(因為HW3沒做出來)

3.answer.js寫在js資料夾裡面main.php會讀不到 所以先把它拿到最外層 目前還在想辦法
