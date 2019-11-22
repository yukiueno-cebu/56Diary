$(document).on('click','.js-like',function(){

    //いいねされた日記のIDを取得
    //$(this)は：今回クリックされた要素のこと
    let diaryId = $(this).siblings('.diary-id').val();

    like(diaryId,$(this));
});
//diaryId:いいねする日記のID
//clicked:今回クリックされたいいねアイコン

function like(diaryId,clickedBtn){
  $.ajax({

    url: 'diary/' + diaryId +'/like',
    type:'POST',
    dataType:'json',
    //CSRF対策のため、tokenを送信する
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }



  }).done((data) =>{
    console.log(data);
    //いいねの数を増やす
    //1.現在のいいねの数を習得する。
    let num = clickedBtn.siblings('.js-like-num').text();

    //numを数値に変換する
    num = Number(num);
    //2.1プラスした結果を設定する
    //text()は中に何も入れなければ取得になるが、何か入れると置き換えになる。
    clickedBtn.siblings('.js-like-num').text(num+1);
    //いいねのボタンのデザインを変更
    changeLikeBtn(clickedBtn);
  }).fail((error) => {
    console.log(error);

    });
}
  //Btn:色を変えたいいいねアイコンをもらうようにする
  function changeLikeBtn(btn){
    btn.toggleClass('far').toggleClass('fas');

    btn.toggleClass('js-like').toggleClass('js-dislike');




}

$(document).on('click','.js-dislike',function(){
   //いいねされた日記のIDを取得
    //$(this)は：今回クリックされた要素のこと
    let diaryId = $(this).siblings('.diary-id').val();

    //dislikeメソッドを実行
    dislike(diaryId,$(this));

});

function dislike(diaryId,clickedBtn){
  $.ajax({

    url: 'diary/' + diaryId +'/dislike',
    type:'POST',
    dataType:'json',
    //CSRF対策のため、tokenを送信する
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }



  }).done((data) =>{
    console.log(data);
    //いいねの数を減らす
    //1.現在のいいねの数を習得する。
    let num = clickedBtn.siblings('.js-like-num').text();

    //numを数値に変換する
    num = Number(num);
    //2.1プラスした結果を設定する
    //text()は中に何も入れなければ取得になるが、何か入れると置き換えになる。
    clickedBtn.siblings('.js-like-num').text(num - 1);
    //いいねのボタンのデザインを変更
    changeLikeBtn(clickedBtn);
  }).fail((error) => {
    console.log(error);

    });
}