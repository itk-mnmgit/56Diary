//いいねボタン押した時の操作
$(document).on('click', '.js-like', function(){
    //いいねされた日記のIDを取得
        //$(this) : 今回クリックされたIタグ
        //.siblings('XXX') : 兄弟要素を取得する
        //val() : input タグのvalueの値を取得する
    let diaryId = $(this).siblings('.diary-id').val();
    like(diaryId, $(this));
});

//いいねボタン再び押した時の操作
$(document).on('click', '.js-dislike', function(){
    let diaryId = $(this).siblings('.diary-id').val();
    dislike(diaryId, $(this));
});

function like(diaryId, clickedBtn) {
    $.ajax({
        url : 'diary/' + diaryId + '/like',
        type : 'POST',
        dataType : 'json',
        //CSRF対策のためのtokenを送信
        headers : {
            'X-CSRF-TOKEN':
            $('meta[name="csrf-token"]').attr('content')
        }
    }).done((data) => {
        //いいねの数を増やす
            //現在のいいねの数を取得
            //text() : <a>XXX</a> XXXの部分を取得
        let num = clickedBtn.siblings('.js-like-num').text()
            //numをテキストから数値に変換
        num = Number(num);
            //＋1した結果を設定する
        clickedBtn.siblings('.js-like-num').text(num + 1);
        //いいねのボタンのデザインを変更
        changeLikeBtn(clickedBtn);
    }).fail((error) => {
        console.log(error);
    });
}

function dislike(diaryId, clickedBtn) {
    $.ajax({
        url : 'diary/' + diaryId + '/dislike',
        type : 'POST',
        dataType : 'json',
        //CSRF対策のためのtokenを送信
        headers : {
            'X-CSRF-TOKEN':
            $('meta[name="csrf-token"]').attr('content')
        }
    }).done((data) => {
        //いいねの数を増やす
            //現在のいいねの数を取得
            //text() : <a>XXX</a> XXXの部分を取得
        let num = clickedBtn.siblings('.js-like-num').text()
            //numをテキストから数値に変換
        num = Number(num);
            //-1した結果を設定する
        clickedBtn.siblings('.js-like-num').text(num - 1);
        //いいねのボタンのデザインを変更
        changeLikeBtn(clickedBtn);
    }).fail((error) => {
        console.log(error);
    });
}

//いいねアイコンの色／クラス変更
function changeLikeBtn(btn){
    btn.toggleClass('far').toggleClass('fas');
    btn.toggleClass('js-like').toggleClass('js-dislike');
}