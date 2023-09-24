<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../style.css">
  <link href="../../asset/jquery-ui.min.css" rel="stylesheet">
  <title>Cooking-Cross</title>
</head>
<style>
	#draggable1,#draggable2,#draggable3,#draggable4,#draggable5,#draggable6 {
		width: 100px; height: 100px; padding: 0.5em;
    user-select: none;
		margin: 10px 10px 10px 0;
	}
	#droppable1,#droppable2,#droppable3,#droppable4,#droppable5,#droppable6 {
		width: 150px; height: 150px; padding: 0.5em;
    user-select: none;
		margin: 10px;
	}
	.droparea{
		margin: 5px;
		display: flex;
	}
	#dropContent{
		margin: 5px;
		display: flex;
	}

  #ques_scene{
    display:none;
  }
</style>
<body>
    
<?php require '../../components/header.php';?>
<div id="draggable_scene">
  <section class="droparea">
    
      <div id="draggable1" class="ui-widget-content">
        <p value="time_point">時間</p>
        <input type="hidden" value="time_point">
      </div>
      <div id="draggable2" class="ui-widget-content">
        <p>予算</p>
        <input type="hidden" value="money_point">
      </div>
      <div id="draggable3" class="ui-widget-content">
        <p>量</p>
        <input type="hidden" value="volume_point">
      </div>
      <div id="draggable4" class="ui-widget-content">
        <p>野菜</p>
        <input type="hidden" value="vegetable_point">
      </div>
      <div id="draggable5" class="ui-widget-content">
        <p>肉</p>
        <input type="hidden" value="meat_point">
      </div>
      <div id="draggable6" class="ui-widget-content">
        <p>魚</p>
        <input type="hidden" value="fish_point">
      </div>
    </section>
    
  <section id="dropContent">
    <div id="droppable1" class="ui-widget-header">
      <p>1</p>
    </div>
    <div id="droppable2" class="ui-widget-header">
      <p>2</p>
    </div>
    <div id="droppable3" class="ui-widget-header">
      <p>3</p>
    </div>
    <div id="droppable4" class="ui-widget-header">
      <p>4</p>
    </div>

    <div id="droppable5" class="ui-widget-header">
      <p>5</p>
    </div>
    <div id="droppable6" class="ui-widget-header">
      <p>6</p>
    </div>
  </section>
  <button id="submit_Btn" disabled>送信</button>
</div>

<div id="ques_scene">
  <p id="question_q1"></p>
  <button id="question_yes" type="submit">Yes</button>
  <button id="question_no" type="submit">No</button>
</div>

<script src="../../asset/jquery-3.7.0.min.js"></script>
<script src="../../asset/jquery-ui.min.js"></script>
<script>

//ドラック&ドロップ
let DropSubmitBtn =document.getElementById("submit_Btn");
let DropTextArray = [];
$( function() {
		$( "#draggable1" ).draggable();
		$( "#draggable2" ).draggable();
		$( "#draggable3" ).draggable();
		$( "#draggable4" ).draggable();
		$( "#draggable5" ).draggable();
		$( "#draggable6" ).draggable();

		$( "#droppable1" ).droppable({
			drop: function( event, ui ) {
        DropTextArray[0] = ui.draggable.find('input').val()
        dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "ドロップされた！" );
        
			},
			out: function(event,ui){
        DropTextArray[0] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "ここにドロップして下さい" )
			}
		});

		$( "#droppable2" ).droppable({
			drop: function( event, ui ) {
        DropTextArray[1] = ui.draggable.find('input').val()
        dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "ドロップされた！" );
			},
			out: function(event,ui){
        DropTextArray[1] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "ここにドロップして下さい" )
			}		
		});

		$( "#droppable3" ).droppable({
			drop: function( event, ui ) {
				DropTextArray[2] = ui.draggable.find('input').val()
        dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "ドロップされた！" );
			},
			out: function(event,ui){
        DropTextArray[2] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "ここにドロップして下さい" )
			}
		});

		$( "#droppable4" ).droppable({
			drop: function( event, ui ) {
          DropTextArray[3] = ui.draggable.find('input').val()
					dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "ドロップされた！" );
			},
			out: function(event,ui){
        DropTextArray[3] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "ここにドロップして下さい" )
			}
		});

		$( "#droppable5" ).droppable({
			drop: function( event, ui ) {
        DropTextArray[4] = ui.draggable.find('input').val()
				dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "ドロップされた！" );
			},
			out: function(event,ui){
        DropTextArray[4] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "ここにドロップして下さい" )
			}
		});

		$( "#droppable6" ).droppable({
			drop: function( event, ui ) {
				DropTextArray[5] = ui.draggable.find('input').val()
        dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "ドロップされた！" );
			},
			out: function(event,ui){
        DropTextArray[5] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "ここにドロップして下さい" )
			}
		});
	});

 //全て配置したか確認
  dropCount = () => {
        FlagArray = DropTextArray.filter(function(value){
            return value != '';
        })

        if(FlagArray.length == 6){
          DropSubmitBtn.disabled = false;
        }else{
          DropSubmitBtn.disabled = true;
        }
  }

  //送信ボタン
  DropSubmitBtn.addEventListener('click',() => {
    document.getElementById('draggable_scene').style.display = "none";
    document.getElementById('ques_scene').style.display = "block";
  },false)

//質問の処理ここから
let data = {
  time: 1,
  money: 1,
  volume:1,
  meat:1,
  fish:1,
  vegetable:1
};

let question_Ele = document.getElementById("question_q1");

let question_yes = document.getElementById("question_yes");
let question_no = document.getElementById("question_no");
let pointsObj = data;

let counter = 1;
window.onload = function() {
  fetch('http://localhost/kamikon2023/content/question/api.php?ques=' + counter)
  .then(
    (response) => response.json()
   )
  .then((json) => {
    console.log(json)
    question_Ele.innerHTML = json.question;
    question_yes.innerHTML = json.YesButtonText;
    question_no.innerHTML = json.NoButtonText;
    counter++;
  }
  );  
}

question_yes.addEventListener('click',() => {
  QuestionCounter();
  fetch('http://localhost/kamikon2023/content/question/api.php?ques=' + counter)
  .then(
    (response) => response.json()
   )
  .then((json) => {
    question_Ele.innerHTML = json.question;
    question_yes.innerHTML = json.YesButtonText;
    question_no.innerHTML = json.NoButtonText;
    pointSave(json.YesPointType)
  }
  );
},false)

question_no.addEventListener('click',() => {
  QuestionCounter()
  fetch('http://localhost/kamikon2023/content/question/api.php?ques=' + counter)
    .then(
      (response) => response.json()
    )
    .then((json) => {
      question_Ele.innerHTML = json.question;
      question_yes.innerHTML = json.YesButtonText;
      question_no.innerHTML = json.NoButtonText;
      pointSave(json.NoPointType)
    }
  );
},false)


pointSave = (type) => {
  //文字列をオブジェクトに変換
  TypeArray = pointsObj.PointType;


  type.map(function(value){
    switch(value){
      case "time":
        pointsObj.time += 1
        console.log('time')
        break
      case "money":
        pointsObj.money += 1
        console.log('money')
        break
      case "volume":
        pointsObj.volume += 1
        console.log('volume')
        break
      case "meat":
        pointsObj.meat += 1
        console.log('meat')
        break
      case "fish":
        pointsObj.fish += 1
        console.log('fish')
        break
      case "vegetable":
        pointsObj.vegetable += 1
        console.log('vegetable')
        break
    }
})
  console.log(pointsObj)
  counter++;
}

QuestionCounter = () =>{
  if(counter > 5){
    let postData = {
      Point:pointsObj,
      Type:DropTextArray
    } 
    
    fetch('http://localhost/kamikon2023/content/question/PostApi.php',{
      method: 'POST',
      headers:{
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(postData)
    }) .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
    .then(json => {
        console.log(json); // やりたい処理
        document.cookie = "Ques_ansawer = " + json;
        location.href = "http://localhost/kamikon2023/content/question/result.php";
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
  }
}
</script>
</body>
</html>
