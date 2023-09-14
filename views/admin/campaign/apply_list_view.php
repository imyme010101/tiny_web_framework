<section class="dark:bg-gray-900 p-3">
  <div class="mx-auto w-full px-4">
    <div class="overflow-x-auto mt-4">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-4 py-3 text-center">이름</th>
            <th scope="col" class="px-4 py-3 text-center">선정여부</th>
            <th scope="col" class="px-4 py-3 text-center">리뷰작성일</th>
            <th scope="col" class="px-4 py-3 text-center">패널티 상태</th>
            <th scope="col" class="px-4 py-3 text-center">포인트 지급</th>
            <th scope="col" class="px-4 py-3 text-center">신청일</th>
            <th scope="col" class="px-4 py-3 text-center">기능</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($data['lists'] as $list) {
            // $category_depth = str_split($list['category_depth'], 3);
            // foreach ($category_depth as &$depth) {
            //   $depth = (int) $depth;
            // }
            $roles = explode(',', $list['roles']);
            ?>
            <tr class="border-b dark:border-gray-700">
              <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                <?php echo $list['name']; ?>
              </th>
              <td class="px-4 py-3 text-center">
                <?php echo $list['status'] == 'Y' ? '선정' : '-'; ?>
              </td>
              <td class="px-4 py-3 text-center">
                <?php echo $list['write_created_at']; ?>
              </td>
              <td class="px-4 py-3 text-center">
                <?php
                echo $data['penaltys_txt'][$roles[2]];
                ?>
              </td>
              <td class="px-4 py-3 text-center">
                <?php echo $list['campaign_reward']; ?>
              </td>
              <td class="px-4 py-3 text-center">
                <?php echo $list['created_at']; ?>
              </td>
              <td class="px-4 py-3 flex items-center justify-center gap-2">
                <button type="button" data-member_id="<?php echo $list['member_id']; ?>" data-campaign_idx="<?php echo $list['campaign_idx']; ?>"
                  class="point_reward_btn block py-1 px-2 text-xs bg-green-600 text-white">포인트 주기</button>

                <button type="button" data-member_id="<?php echo $list['member_id']; ?>"
                  class="penalty_modal_btn block py-1 px-2 text-xs bg-red-600 text-white">패널티 주기</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <nav class="w-full flex flex-col">
      <div class="w-full flex items-center justify-center">
        <?php
        echo $data['pagination_html'];
        ?>
      </div>
      <!-- <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mt-2 flex items-end justify-end">
        <a href="/admin/campaign/write" class="bg-black text-white py-2 px-4 rounded-sm">생성</a>
      </span> -->
    </nav>
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
          <input type="text" name="member_id" id="member_id" readonly class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" value="" />
          
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
<!-- Code block ends -->

<script>
  $(document).ready(function () {
    const category_lv2_obj = <?php echo json_encode($data['category_lv2']) ?>;

    $('#category_lv1').change(function () {
      var category_lv1 = $(this).val();

      $('#category_lv2').empty();
      $('#category_lv2').append('<option>소카테고리 선택 하세요.</option>');

      for (var i = 0; i < Object.keys(category_lv2_obj[category_lv1]).length; i++) {
        $('#category_lv2').append('<option value="' + Object.keys(category_lv2_obj[category_lv1])[i] + '">' + Object.values(category_lv2_obj[category_lv1])[i] + '</option>');
      }
    });

    $('#campaign-drop-button').click(function () {
      $('#campaign-drop-dropdown').toggleClass('hidden');
    });

    $('.penalty_modal_btn').click(function () {
      modalHandler(true);

      var member_id = $(this).data('member_id');
      $('#member_id').val(member_id);
    });

    $('.point_reward_btn').click(function () {
      var member_id = $(this).data('member_id');
      var campaign_idx = $(this).data('campaign_idx');

      var formData = new FormData();
      formData.append('member_id', member_id);
      formData.append('campaign_idx', campaign_idx);

      $.ajax({
        url: '/campaign/campaign_point',
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
    })

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