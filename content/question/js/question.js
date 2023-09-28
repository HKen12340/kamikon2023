//質問の処理ここから
const APIURL = "http://localhost/kamikon2023/content/question/api.php";
const POSTAPIURL = "http://localhost/kamikon2023/content/question/PostApi.php";
const RESULT_URL = "http://localhost/kamikon2023/content/question/result.php";

let data = {
  time: 0,
  money: 0,
  volume:0,
  meat:0,
  fish:0,
  vegetable:0
};

let question_Ele = document.getElementById("question_q1");

let question_yes = document.getElementById("question_yes");
let question_no = document.getElementById("question_no");
let pointsObj = data;

let counter = 1;
window.onload = function() {
  fetch(APIURL + '?ques=' + counter)
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
  fetch(APIURL + '?ques=' + counter)
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
  fetch(APIURL + '?ques=' + counter)
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

  //ポイント加算
  type.map(function(value){
    switch(value){
      case "time":
        pointsObj.time += 1
        break
      case "money":
        pointsObj.money += 1
        break
      case "volume":
        pointsObj.volume += 1
        break
      case "meat":
        pointsObj.meat += 1
        break
      case "fish":
        pointsObj.fish += 1
        break
      case "vegetable":
        pointsObj.vegetable += 1
        break
    }
})
  counter++;
}

QuestionCounter = () =>{
  if(counter > 5){
    let postData = {
      Point:pointsObj,
      Type:DropTextArray
    } 
    //溜まったポイントを参考にレシピを提案
    fetch(POSTAPIURL,{
      method: 'POST',
      headers:{
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(postData)
    }) .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
    .then(json => {
      //結果をCookieに保存
      console.log(json);
        document.cookie = "Ques_ansawer = " + json;
        location.href = RESULT_URL;
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
  }
}