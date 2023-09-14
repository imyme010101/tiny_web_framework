<section class="dark:bg-gray-900 p-3">
  <div class="mx-auto w-full px-4">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
      <div class="w-full flex flex-col p-3 space-y-2 items-stretch ustify-end flex-shrink-0">
        <div class="flex flex-col pb-5 gap-2">
          <label class="font-semibold text-gray-700 pb-4">
            기본 정보
          </label>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              아이디
            </label>
            <div class="flex-1">
              <input type="text" name="id" value="<?php echo @$data['view']['id']; ?>" disabled
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
            </div>

          </div>
          <div class="flex justify-between gap-2">
            <div class="flex w-1/2 items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                이름
              </label>
              <div class="flex-1">
                <input type="text" name="name" value="<?php echo @$data['view']['name']; ?>" disabled
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
              </div>
            </div>
            <div class="flex w-1/2 items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                닉네임
              </label>
              <div class="flex-1">
                <input type="text" name="nick" value="<?php echo @$data['view']['nick']; ?>" disabled
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
              </div>
            </div>
          </div>


          <div class="flex justify-between gap-2">
            <div class="flex w-1/2 items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                이메일
              </label>
              <div class="flex-1">
                <input type="text" name="email" value="<?php echo @$data['view']['email']; ?>" disabled
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
              </div>
            </div>
            <div class="flex w-1/2 items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                성별
              </label>
              <div class="flex-1">
                <select name="gender" disabled
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                  <option value="MALE" <?php echo @$data['view']['gender'] == 'MALE' ? 'selected' : '' ?>>남성</option>
                  <option value="FEMALE" <?php echo @$data['view']['gender'] == 'FEMALE' ? 'selected' : '' ?>>여성</option>
                </select>
              </div>
            </div>
          </div>


          <div class="flex flex-col pb-5 gap-2">
            <label class="font-semibold text-gray-700 pb-4">
              미디어 정보
            </label>
            <div class="flex-1 flex">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
              </label>
              <div class="w-full grid grid-cols-2 gap-2">
                <?php
                $sns = json_decode($data['view']['sns']);

                foreach ($data['media'] as $media_key => $media) {
                  if ($media_key == 'receipt')
                    continue;
                  ?>
                  <div class="flex items-center justify-center">
                    <label class="text-xs m-0 w-20 font-medium text-gray-700">
                      <?php echo $media[1]; ?>
                    </label>
                    <div class="flex-1 flex justify-between items-center gap-2">
                      <input placeholder="" disabled value="<?php echo $sns->{$media_key}; ?>"
                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>


          </div>

          <div class="flex flex-col gap-2">
            <label class="font-semibold text-gray-700 pb-4">
              기타 정보
            </label>

            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                배송 주소
              </label>
              <div class="flex-1 flex flex-col gap-2">
                <div class="w-full flex justify-between items-center gap-2">
                  <input placeholder="우편번호" disabled value="<?php echo $data['view']['zip_code'] ?>"
                    class="w-28 text-black placeholder-gray-600 px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                  <input placeholder="기본 주소" disabled value="<?php echo $data['view']['address'] ?>"
                    class="flex-1 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                </div>
                <input placeholder="상세 주소" disabled value="<?php echo $data['view']['address_detail'] ?>"
                  class="flex-1 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
              </div>
            </div>

            <?php if (@$_GET['id']) { ?>
            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                프로필 사진
              </label>
              <div class="flex-1 flex justify-between items-center gap-2">
                <input type="file" name="profile_image"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
              </div>
            </div>
          
            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                생성일
              </label>
              <div class="flex-1 flex justify-between items-center gap-2">
                <?php echo @$data['view']['created_at']; ?>
              </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>


      <div class="overflow-x-auto mt-4">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th class="px-4 py-3 text-center">패널티</th>
              <th class="px-4 py-3 text-center">패널티 내용</th>
              <th class="px-4 py-3 text-center">패널티 일자</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($data['penalty_list']['lists'] as $penalty) {
            ?>
            <tr class="border-b dark:border-gray-700">
              <th class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center"><?php echo $penalty['penalty']; ?></th>
              <td class="px-4 py-3 text-center"><?php echo $penalty['comment']; ?></td>
              <td class="px-4 py-3 text-center"><?php echo $penalty['created_at']; ?></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>


        <div class="flex gap-2 w-full p-2 justify-end">
          <button type="button" class="bg-black text-white py-2 px-4 rounded-sm penalty_modal_btn">패널티
            추가</button>
        </div>
      </div>


</section>

<dh-component>

  <div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden"
    style="opacity: 0;" id="penalty_modal">
    <div role="alert"
      class="fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 container mx-auto w-11/12 md:w-2/3 max-w-lg">
      <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
        <form name="submitForm" id="submitForm" method="post">
          <div class="w-full flex justify-start text-gray-600 mb-3">
            </div>
          <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">패널티 추가</h1>
          <input type="text" name="member_id" id="member_id" value="<?php echo $data['view']['id']; ?>" readonly class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" value="" />
          
          <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">패널티</label>
          <select
            name="penalty"
            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border">
            <?php
            foreach ($data['penaltys'] as $penalty) {
              ?>
              <option value="<?php echo $penalty['role']; ?>"><?php echo $penalty['name']; ?></option>
              <?php
            }
            ?>
          </select>
          <label for="email2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">패널티 내용</label>
          <div class="relative mb-5 mt-2">
            <textarea
              name="comment"
              class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"></textarea>
          </div>

          <div class="flex items-center justify-start w-full">
            <button
              type="button"
              class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700 transition duration-150 ease-in-out hover:bg-gray-600 bg-gray-700 rounded text-white px-8 py-2 text-sm submitForm">Submit</button>
            <button
              type="button"
              class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm"
              onclick="modalHandler()">Cancel</button>
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
        </form>
      </div>
    </div>
  </div>

  <script>
    let modal = document.getElementById("penalty_modal");
    // body 문서 세로 사이즈
    let modal_height = document.body.scrollHeight;
    modal.style.height = modal_height + "px";

    function modalHandler(val) {
      if (val) {
        fadeIn(modal);
      } else {
        fadeOut(modal);
      }
    }
    function fadeOut(el) {
      el.style.opacity = 1;
      $(el).removeClass("hidden");

      document.body.style.overflow = "";
      // div 가운데 위치



      (function fade() {
        if ((el.style.opacity -= 0.1) < 0) {
          el.style.display = "none";
        } else {
          requestAnimationFrame(fade);
        }
      })();
    }
    function fadeIn(el, display) {
      el.style.opacity = 0;
      el.style.display = display || "flex";
      $(el).addClass("hidden");

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

<script type="text/javascript">
  $(document).ready(function () {
    const category_lv2_obj = <?php echo json_encode($data['category_lv2']) ?>;

    $('#category_lv1').change(function () {
      var category_lv1 = $(this).val();

      $('#category_lv2').empty();
      $('#category_lv2').append('<option>소카테고리 선택 하세요.</option>');

      for (var i = 0; i < category_lv2_obj[category_lv1].length; i++) {
        $('#category_lv2').append('<option value="' + category_lv2_obj[category_lv1][i]['idx'] + '">' + category_lv2_obj[category_lv1][i]['name'] + '</option>');
      }
    });


    $('.penalty_modal_btn').click(function () {
      modalHandler(true);
    });

    $(".submitForm").click(function () {
      var form = $('#submitForm')[0];
      var formData = new FormData(form);

      $.ajax({
        url: '/member/penalty',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        type: 'POST',
        success: function (data) {
          if (data.code == 200) {
            alert("정상적으로 처리 되었습니다.");
            
            location.reload();
          } else {
            alert("Error : " + data.code + " => " + data.message);
          }
        }
      });

    });    
  });
</script>