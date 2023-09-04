<dh-component>

  <div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden"
    style="opacity: ;" id="post_modal" onclick="post_modalHandler()">
    <div role="alert"
      class="fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 container mx-auto w-11/12 md:w-2/3 max-w-lg">
      <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
        <div class="w-full flex justify-start text-gray-600 mb-3">

        </div>
        <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">우편번호 검색</h1>
        <div class="flex-1 flex" id="postLayer">
        </div>

        <button
          class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
          onclick="modalHandler()" aria-label="close modal" role="button">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20"
            viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <script>
    let post_modal = document.getElementById("post_modal");
    // body 문서 세로 사이즈
    let post_modal_height = document.body.scrollHeight;
    post_modal.style.height = post_modal_height + "px";

    function post_modalHandler(val) {
      if (val) {
        var postLayer = document.getElementById("postLayer");

        new daum.Postcode({
          oncomplete: function (data) { // 주소 선택을 완료했을 때
            /*
            * 주소 선택 시 API는 zonecode, address를 return
            */
            $('#zip_code').val(data.zonecode);
            $('#address').val(data.address);

            post_fadeOut(post_modal);
          },
          onclose: function (state) {
            if (state === "COMPLETE_CLOSE") { // 주소 선택으로 인한 close일 경우
              postLayer.innerHTML = ''; // 레이어 적용 해제

              post_fadeOut(post_modal);
            }
          },
          width: '100%',
        }).embed(postLayer); // 생성해둔 div에 layer를 적용

        post_fadeIn(post_modal);
      } else {
        post_fadeOut(post_modal);
      }
    }
    function post_fadeOut(el) {
      el.style.opacity = 1;
      $(el).addClass("hidden");
      document.body.style.overflow = "";


      (function fade() {
        if ((el.style.opacity -= 0.1) < 0) {
          $(el).addClass("hidden");
        } else {
          requestAnimationFrame(fade);
        }
      })();
    }
    // 오픈
    function post_fadeIn(el, display) {
      el.style.opacity = 0;
      $(el).removeClass("hidden");

      document.body.style.overflow = "hidden";

      (function fade() {
        let val = parseFloat(el.style.opacity);
        if (!((val += 0.2) > 1)) {
          el.style.opacity = val;
          requestAnimationFrame(fade);
        }
      })();
    }
  </script>

</dh-component>
<!-- Code block ends -->
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>