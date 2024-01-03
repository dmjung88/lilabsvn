@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style1.css') }}">
<div>
    <link rel="stylesheet" href="{{ asset('css/index1.css') }}">

  <div class="frame-container">
    <div class="frame-frame">
      <img
        alt="Rectangle52687"
        src="../public1/rectangle52687-biu-1500h.png"
        class="frame-rectangle5"
      />
      <img
        alt="bar12687"
        src="../public1/bar12687-xpm5-200h.png"
        class="frame-bar1"
      />
      <img
        alt="bar22687"
        src="../public1/bar22687-mj7q-200h.png"
        class="frame-bar2"
      />
      <div class="frame-layer1">
        <div class="frame-group1">
          <img
            alt="Vector2687"
            src="../public1/vector2687-0uc.svg"
            class="frame-vector"
          />
          <img
            alt="Vector2687"
            src="{{ asset('public1/vector2687-inzk.svg') }}"
            class="frame-vector01"
          />
          <img
            alt="Vector2687"
            src="../public1/vector2687-ysi9.svg"
            class="frame-vector02"
          />
          <img
            alt="Vector2688"
            src="../public1/vector2688-cl47.svg"
            class="frame-vector03"
          />
          <img
            alt="Vector2688"
            src="../public1/vector2688-4a3r.svg"
            class="frame-vector04"
          />
          <img
            alt="Vector2688"
            src="../public1/vector2688-6c35.svg"
            class="frame-vector05"
          />
          <img
            alt="Vector2688"
            src="../public1/vector2688-yin9.svg"
            class="frame-vector06"
          />
          <img
            alt="Vector2688"
            src="../public1/vector2688-55.svg"
            class="frame-vector07"
          />
          <img
            alt="Vector2688"
            src="../public1/vector2688-pxxl.svg"
            class="frame-vector08"
          />
          <img
            alt="Vector2688"
            src="../public1/vector2688-8mtg.svg"
            class="frame-vector09"
          />
        </div>
      </div>
      <span class="frame-text"><span>최강 수리업체</span></span>
      <span class="frame-text02"><span>로그아웃</span></span>
      <span class="frame-text04"><span>홍길동</span></span>
      <span class="frame-text06"><span>마스터</span></span>
      <img
        alt="container2690"
        src="../public1/container2690-5kyb-800w.png"
        class="frame-container1"
      />
      <span class="frame-text08"><span>도매장명</span></span>
      <span class="frame-text10">*</span>
      <span class="frame-text11">*</span>
      <span class="frame-text12"><span>전화번호</span></span>
      <span class="frame-text14"><span>대표자명</span></span>
      <span class="frame-text16"><span>업태</span></span>
      <span class="frame-text18"><span>종목</span></span>
      <span class="frame-text20"><span>이메일</span></span>
      <span class="frame-text22"><span>사용여부</span></span>
      <span class="frame-text24"><span>우편번호</span></span>
      <span class="frame-text26"><span>사업자번호</span></span>
      <span class="frame-text28"><span>주소</span></span>
      <span class="frame-text30"><span>상세주소</span></span>
      <form id="wholeSaveForm" autocomplete="off">
        <input type="text" id="wholeName" name="wholeName" placeholder="도매장명을 입력해 주세요." class="frame-rectangle23" />
        <span style="color: #b94a48; font-weight: bold">@error('wholeName'){{ $message }} @enderror</span>
        <input type="text" id="wholePhone" name="wholePhone" placeholder="숫자만 입력해 주세요." class="frame-rectangle24" />
        <input type="text" id="wholeCeo" name="wholeCeo" placeholder="이름을 입력해 주세요." class="frame-rectangle26" />
        <input type="text" id="wholeBiz" name="wholeBiz" placeholder="업태를 입력해 주세요." class="frame-rectangle27" />
        <input type="text" id="wholeType" name="wholeType" placeholder="종목을 입력해 주세요." class="frame-rectangle28" />
        <input type="text" id="wholeEmail" name="wholeEmail" placeholder="이메일을 입력해 주세요." class="frame-rectangle32" />
        <input type="text" id="wholeZipcode" name="wholeZipcode" placeholder="우편번호를 입력해 주세요." class="frame-rectangle31" readonly="readonly" />
        <input type="text" id="wholeBizNum" name="wholeBizNum" placeholder="사업자번호를 입력해 주세요." class="frame-rectangle25" />
        <input type="text" id="addr" name="addr" placeholder="주소를 입력해주세요." class="frame-rectangle29" readonly="readonly"/>
        <input type="text" id="addrDetail" name="addrDetail" placeholder="상세주소를 입력해 주세요." class="frame-rectangle30" readonly="readonly"/>
        <img alt="Btnlogout4049" scr="{{ asset('public1/btnlogout4049-xedg.svg') }}" class="frame-btnlogout" />
        <div class="frame-frame14">
            <div class="frame-frame1">
            <span class="frame-text52"><span>도매장</span></span>
            </div>
            <div class="frame-frame2">
            <span class="frame-text54"><span>업소</span></span>
            </div>
            <div class="frame-frame3">
            <span class="frame-text56"><span>상품</span></span>
            </div>
            <div class="frame-frame4">
            <span class="frame-text58"><span>수리업무</span></span>
            </div>
            <div class="frame-frame5">
            <span class="frame-text60"><span>영업사원</span></span>
            </div>
        </div>
        <div class="frame-frame32">
            <div class="frame-gnb">
            <span class="frame-text62"><span>마스터</span></span>
            </div>
            <div class="frame-gnb1">
            <span class="frame-text64"><span>업무</span></span>
            </div>
            <div class="frame-gnb2">
            <span class="frame-text66"><span>발행</span></span>
            </div>
            <div class="frame-gnb3">
            <span class="frame-text68"><span>채권</span></span>
            </div>
            <div class="frame-gnb4">
            <span class="frame-text70"><span>세금계산서</span></span>
            </div>
        </div>
        <div class="frame-btn-off-on">
            <div class="frame-btn-off-on1">
            <span class="frame-text72"><input type="radio" name="chk_status" value="N"><span>OFF</span></span>
            </div>
            <div class="frame-btn-off-on2">
            <span class="frame-text72"><input type="radio" name="chk_status" value="Y" checked><span>ON</span></span>
            </div>
        </div>
        <div class="frame-footer">
            <span class="frame-text76">
            <span>Copyright © 2023 릴랩. all rights reserved</span>
            </span>
        </div>
        <div class="frame-btn-check">
            <span class="frame-text78"><button type="button" id="wholeCheckBtn">체크</button></span>
        </div>
        <div class="frame-btn-check1">
            <span class="frame-text79"><button type="button" onclick="execution_daum_address()">주소검색</button></span>
        </div>
        <div class="frame-btn-basic-blue">
            <input type="button" id="wholeSaveBtn" class="frame-text80" value="저장">
        </div>
      </form>
    </div>
  </div>
</div>
<script src="../js/form-validation1.js"></script>
<script type="text/javascript">
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //post 글작성 + 수정
    $('#wholeSaveBtn').click(function (e) {
        if(checkInput() == true) {
          $.ajax({
              data: $('#wholeSaveForm').serialize(),
              url: "{{ url('api/master/wholesale') }}",
              type: "POST",
              dataType: 'json',
              success: function (data) {
                  console.info(data);
                  if(data.success == true) {
                      $('#wholeSave').trigger("reset");
                      alert('저장성공');
                      history.go(0);
                  }
              },
              error: function (err) {
                  console.log('Error:', err);
              }
          });
        } //endCheckInput
    })
}); //endJQ
</script>
@endsection