<section class="dark:bg-gray-900 p-3">
  <div class="mx-auto w-full px-4">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
      <div class="w-full flex flex-col p-3 space-y-2 items-stretch ustify-end flex-shrink-0">
        <div class="pb-5">
          <input placeholder="캠페인 제목을 입력 하세요."
            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
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
                  <?php echo $media_val; ?>
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
          <ul class="flex items-center justify-start gap-2">
            <?php
            foreach ($data['category_lv1'] as $category) {
              ?>
              <li class="text-xs">

                <input class="sr-only peer" type="radio" value="yes" name="category"
                  id="category_<?php echo $category['idx']; ?>">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="category_<?php echo $category['idx']; ?>">
                  <?php echo $category['name']; ?>
                </label>

              </li>
              <?php
            }
            ?>
          </ul>
        </div>


        <div class="flex flex-col pb-5">
          <label class="text-sm font-medium text-gray-700">
            등록일
          </label>
          <div class="flex">
            <ul class="flex items-center justify-start gap-2">
              <li class="text-xs">
                <input class="sr-only peer" type="radio" value="yes" name="category" id="date_day">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="date_day">
                  1일
                </label>
              </li>
              <li class="text-xs">
                <input class="sr-only peer" type="radio" value="yes" name="category" id="date_week">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="date_week">
                  1주
                </label>
              </li>
              <li class="text-xs">
                <input class="sr-only peer" type="radio" value="yes" name="category" id="date_1month">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="date_1month">
                  1개월
                </label>
              </li>
              <li class="text-xs">
                <input class="sr-only peer" type="radio" value="yes" name="category" id="date_3month">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="date_3month">
                  3개월
                </label>
              </li>
              <li class="text-xs">
                <input class="sr-only peer" type="radio" value="yes" name="category" id="date_6month">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="date_6month">
                  6개월
                </label>
              </li>
              <li class="text-xs">
                <input class="sr-only peer" type="radio" value="yes" name="category" id="date_1year">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="date_1year">
                  1년
                </label>
              </li>
              <li class="text-xs">
                <input class="sr-only peer" type="radio" value="yes" name="category" id="date_3year">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="date_3year">
                  3년
                </label>
              </li>
              <li class="text-xs">
                <input class="sr-only peer" type="radio" value="yes" name="category" id="date_all">
                <label
                  class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                  for="date_all">
                  전체
                </label>
              </li>
            </ul>
            <div class="flex items-center justify-between ml-8 gap-2">
              <input type="text" class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400" />
              <span>-</span>
              <input type="text" class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400" />
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
            <th scope="col" class="px-4 py-3">캠페인 제목</th>
            <th scope="col" class="px-4 py-3">진행 현황</th>
            <th scope="col" class="px-4 py-3">미디어</th>
            <th scope="col" class="px-4 py-3">카테고리</th>
            <th scope="col" class="px-4 py-3">주소</th>
            <th scope="col" class="px-4 py-3">리뷰어 신청수</th>
            <th scope="col" class="px-4 py-3">생성일</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b dark:border-gray-700">
            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple iMac
              27&#34;</th>
            <td class="px-4 py-3">PC</td>
            <td class="px-4 py-3">Apple</td>
            <td class="px-4 py-3">300</td>
            <td class="px-4 py-3">$2999</td>
            <td class="px-4 py-3 flex items-center justify-end">
              <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown"
                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                type="button">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
              </button>
              <div id="apple-imac-27-dropdown"
                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="apple-imac-27-dropdown-button">
                  <li>
                    <a href="#"
                      class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                  </li>
                  <li>
                    <a href="#"
                      class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a href="#"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <nav class="w-full flex flex-col justify-between items-start">
      <div class="w-full flex items-center justify-center">
        <?php
        echo $data['pagination_html'];
        ?>
      </div>
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
        <button type="button" class="bg-black text-white py-2 px-4 rounded-sm">생성</button>
      </span>
    </nav>
  </div>
  </div>
</section>