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
    text-align: center;
	}
	#droppable1,#droppable2,#droppable3,#droppable4,#droppable5,#droppable6 {
		width: 120px; height: 120px; padding: 0.5em;
    user-select: none;
		margin: 10px;
    text-align: center;
	}

	.droparea{
		margin: 0 auto;
    width: 50%;
    display: flex;
    justify-content: space-around;
	}
	#dropContent{
    margin: 0 auto;
    width: 80%;
		display: flex;
    justify-content: space-around;
    align-items: center;
	}

  #ques_scene{
    display:none;
    width: 70%;
    margin: 0 auto;

  }
  #submit_Btn{
    padding: 10px 60px;
    /* background-color: blue; */
    font-size: 20px;
    border: none;
    color: white;
    border-radius: 5px;

  }
  .SubmitBtn_Area{
    margin-top: 50px;
    text-align: center;
  }
  .container {
  position: relative;
}

  #start_scene{
    margin-top: 12%;
    text-align: center;
  }
  #QuesStartBtn{
    padding: 10px 60px;
    background-color: blue;
    font-size: 20px;
    border: none;
    color: white;
    border-radius: 5px;
  }

  #QuesStartBtn:hover{
    background-color: rgb(110, 110, 246);
  }
</style>
<body>
    
<?php require '../../components/header.php';?>
<div id="start_scene">
    <h2>質問の解答に合わせて、最適なレシピを提案します</h2>
    <button id = "QuesStartBtn">スタート</button>
</div>
<div id="draggable_scene">
  <h3 class="Question_DragglbleH3">6つの要素を重要度の高い順にドラックアンドドロップで配置してください</h3>
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
  <section class="SubmitBtn_Area">
    <button id="submit_Btn" disabled>送信</button>
  </section>
</div>

<div id="ques_scene">
  <p id="question_q1"></p>
  <div class="question_YesNoButtonArea">
    <button id="question_yes" type="submit">Yes</button>
    <button id="question_no" type="submit">No</button>
  </div>
</div>
<script>
  let start_scene = document.getElementById("start_scene");
  let draggable_scene = document.getElementById("draggable_scene");
  let QuesStartBtn = document.getElementById("QuesStartBtn");
  draggable_scene.style.display= "none";

  QuesStartBtn.addEventListener("click",function(){
    start_scene.style.display= "none";
    draggable_scene.style.display= "block";
  },false)
</script>
<script src="../../asset/jquery-3.7.0.min.js"></script>
<script src="../../asset/jquery-ui.min.js"></script>
<script src="js/draggable.js"></script>
<script src="js/question.js"></script>
</body>
</html>
