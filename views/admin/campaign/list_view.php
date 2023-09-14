<section class="dark:bg-gray-900 p-3">
  <div class="mx-auto w-full px-4">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
      <div class="w-full flex flex-col p-3 space-y-2 items-stretch ustify-end flex-shrink-0">
        <div class="flex pb-5">
          <select
            class="text-black placeholder-gray-600 w-28 px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-l-lg bg-gray-200  focus:border-blueGray-500 focus:outline-none focus:shadow-outline">
            <option value="name">이름</option>
            <option value="id">아이디</option>
          </select>
          <input placeholder="캠페인 제목을 입력 하세요."
            class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base  transition duration-500 ease-in-out transform border-transparent rounded-r-lg bg-gray-200  focus:border-blueGray-500 focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex flex-col pb-2">
          <label class="text-sm font-medium text-gray-700">
            미디어
          </label>
          <ul class="flex items-center justify-start gap-2">
            <?php
            foreach ($data['media'] as $media_key => $media_val) {
              ?>
              <li class="text-xs">

                <input class="sr-only peer" type="radio" value="yes" name="media" id="media_<?php echo $media_key; ?>">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="media_<?php echo $media_key; ?>">
                  <?php echo $media_val[1] ?>
                </label>

              </li>
              <?php
            }
            ?>
          </ul>
        </div>

        <div class="flex flex-col pb-5">
          <label class="text-sm font-medium text-gray-700">
            카테고리
          </label>
          <div class="flex gap-2">
            <select id="category_lv1" name="parent_category_idx"
              class="w-1/2 text-black placeholder-gray-600 px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              <option>카테고리 선택 하세요.</option>
              <?php
              foreach ($data['category_lv1'] as $cate_key => $cate_val) {
                ?>
                <option value="<?php echo $cate_key; ?>" <?php echo $cate_key == @$data['category_depth'][0] ? 'selected' : ''; ?>>
                  <?php echo $cate_val; ?>
                </option>
                <?php
              }
              ?>
            </select>

            <select id="category_lv2" name="category_idx"
              class="w-1/2 text-black placeholder-gray-600 px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              <option>소카테고리 선택 하세요.</option>
              <?php
              foreach ($data['category_lv2'][$data['category_depth'][0]] as $cate2_key => $cate2_val) {
                ?>
                <option value="<?php echo $cate2_key; ?>" <?php echo $cate2_key == @$data['category_depth'][1] ? 'selected' : ''; ?>>
                  <?php echo $cate2_val; ?>
                </option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>


        <div class="flex flex-col pb-5">
          <label class="text-sm font-medium text-gray-700">
            등록일
          </label>
          <div class="flex">
            <div class="flex items-center justify-between gap-2">
              <input type="date"
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400" />
              <span>-</span>
              <input type="date"
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400" />
            </div>
          </div>
        </div>
      </div>
      <div class="flex gap-2 w-full p-2 justify-center">
        <button type="button" class="border border-black bg-white text-black py-2 px-4 rounded-sm">검색 초기화</button>
        <button type="button" class="bg-black text-white py-2 px-4 rounded-sm">검색</button>
      </div>
    </div>


    <div class="overflow-x-auto mt-4">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-4 py-3 text-center">캠페인 제목</th>
            <th scope="col" class="px-4 py-3 text-center">진행 현황</th>
            <th scope="col" class="px-4 py-3 text-center">미디어</th>
            <th scope="col" class="px-4 py-3 text-center">카테고리</th>
            <th scope="col" class="px-4 py-3 text-center">리뷰어 신청수</th>
            <th scope="col" class="px-4 py-3 text-center">기능</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($data['lists'] as $list) {
            $category_depth = str_split($list['category_depth'], 3);
            foreach ($category_depth as &$depth) {
              $depth = (int) $depth;
            }
          ?>
            <tr class="border-b dark:border-gray-700">
              <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                <?php echo $list['title']; ?>
              </th>
              <td class="px-4 py-3 text-center">
                
              </td>
              <td class="px-4 py-3 text-center">
                <?php echo $list['media']; ?>
              </td>
              <td class="px-4 py-3 text-center">
                <?php echo $data['category_lv1'][$category_depth[0]]; ?> / <?php echo $data['category_lv2'][$category_depth[0]][$category_depth[1]]; ?>
              </td>
              <td class="px-4 py-3 text-center"><?php echo $list['stock']; ?></td>
              <td class="px-4 py-3 flex items-center justify-center">
                <button id="campaign-drop-button"
                  class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                  type="button">
                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                  </svg>
                </button>
                <div id="campaign-drop-dropdown"
                  class="hidden z-10 w-44 absolute bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="apple-imac-27-dropdown-button">
                    <li>
                      <a href="/admin/campaign/apply_view?idx=<?php echo $list['idx']; ?>" target="_blank"
                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">신청자 보기</a>
                    </li>
                    <li>
                      <a href="/admin/campaign/view?idx=<?php echo $list['idx']; ?>"
                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">보기</a>
                    </li>
                    <li>
                      <a href="/admin/campaign/write?idx=<?php echo $list['idx']; ?>"
                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">수정</a>
                    </li>
                  </ul>
                  <div class="py-1">
                    <button type="button" href="/admin/campaign/delete?idx=<?php echo $list['idx']; ?>"
                      class="campaign-delete block py-2 px-4 text-sm text-pink-600">삭제</button>
                  </div>
                </div>
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
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mt-2 flex items-end justify-end">
        <a href="/admin/campaign/write" class="bg-black text-white py-2 px-4 rounded-sm">생성</a>
      </span>
    </nav>
  </div>
</section>

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

    $('#campaign-drop-button').click(function() {
      $('#campaign-drop-dropdown').toggleClass('hidden');
    });

    $('#campaign-delete').click(function() {
      
    });
  });

</script>