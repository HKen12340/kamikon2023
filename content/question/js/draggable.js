//ドラック&ドロップ

let DropSubmitBtn =document.getElementById("submit_Btn");
DropSubmitBtn.style.backgroundColor = "rgb(248, 248, 255);"
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
				.html( "1" );
        
			},
			out: function(event,ui){
        DropTextArray[0] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "1" )
			}
		});

		$( "#droppable2" ).droppable({
			drop: function( event, ui ) {
        DropTextArray[1] = ui.draggable.find('input').val()
        dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "2" );
			},
			out: function(event,ui){
        DropTextArray[1] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "2" )
			}		
		});

		$( "#droppable3" ).droppable({
			drop: function( event, ui ) {
				DropTextArray[2] = ui.draggable.find('input').val()
        dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "3" );
			},
			out: function(event,ui){
        DropTextArray[2] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "3" )
			}
		});

		$( "#droppable4" ).droppable({
			drop: function( event, ui ) {
          DropTextArray[3] = ui.draggable.find('input').val()
					dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "4" );
			},
			out: function(event,ui){
        DropTextArray[3] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "4" )
			}
		});

		$( "#droppable5" ).droppable({
			drop: function( event, ui ) {
        DropTextArray[4] = ui.draggable.find('input').val()
				dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "5" );
			},
			out: function(event,ui){
        DropTextArray[4] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "5" )
			}
		});

		$( "#droppable6" ).droppable({
			drop: function( event, ui ) {
				DropTextArray[5] = ui.draggable.find('input').val()
        dropCount()
				$( this )
				.addClass( "ui-state-highlight" )
				.find( "p" )
				.html( "6" );
			},
			out: function(event,ui){
        DropTextArray[5] = ''
        dropCount()
				$( this )
				.removeClass("ui-state-highlight")
				.find( "p" )
				.html( "6" )
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
					DropSubmitBtn.style.backgroundColor = "blue";
        }else{
          DropSubmitBtn.disabled = true;
        }
  }

  //送信ボタン
  DropSubmitBtn.addEventListener('click',() => {submit_Btn
    document.getElementById('draggable_scene').style.display = "none";
    document.getElementById('ques_scene').style.display = "block";
		
  },false)
