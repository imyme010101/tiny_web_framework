


<section class="dark:bg-gray-900 p-3">
  <div class="mx-auto w-full px-4">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
      <div class="w-full flex flex-col p-3 space-y-2 items-stretch ustify-end flex-shrink-0">
        <div class="flex pb-5">
          <select class="text-black placeholder-gray-600 w-28 px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-l-lg bg-gray-200  focus:border-blueGray-500 focus:outline-none focus:shadow-outline">
            <option value="name">이름</option>
            <option value="id">아이디</option>
          </select>
          <input placeholder="캠페인 제목을 입력 하세요."
            class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base  transition duration-500 ease-in-out transform border-transparent rounded-r-lg bg-gray-200  focus:border-blueGray-500 focus:outline-none focus:shadow-outline">
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
            <th scope="col" class="px-4 py-3">아이디</th>
            <th scope="col" class="px-4 py-3">닉네임</th>
            <th scope="col" class="px-4 py-3">전화번호</th>
            <th scope="col" class="px-4 py-3">등급</th>
            <th scope="col" class="px-4 py-3">패널티</th>
            <th scope="col" class="px-4 py-3">연결 미디어</th>
            <th scope="col" class="px-4 py-3">포인트</th>
            <th scope="col" class="px-4 py-3">생성일</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($data['lists'] as $member) {
            $roles = explode(',', $member['roles']);

            $rating = @$data['ratings_txt'][$roles[1]];
            $penalty = @$data['penaltys_txt'][$roles[2]];
            $use_sns = explode(',', $member['use_sns']);
          ?>
          <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3"><a href="/admin/member/view?id=<?php echo $member['id']; ?>" target="_blank"><?php echo $member['id']; ?></a></td>
            <td class="px-4 py-3"><?php echo $member['nick']; ?></td>
            <td class="px-4 py-3"><?php echo $member['phone_number']; ?></td>
            <td class="px-4 py-3 font-bold"><?php echo $rating; ?></td>
            <td class="px-4 py-3 font-bold"><?php echo $penalty; ?></td>
            <td class="px-4 py-3">
              <?php
                foreach($use_sns as $sns) {
                  echo $sns . ', ';
                }
              ?>
            </td>
            <td class="px-4 py-3"><?php echo $member['point']; ?></td>
            <td class="px-4 py-3"><?php echo date("Y.m.d", strtotime($member['created_at'])); ?></td>
          </tr>
          <?php
          }
          ?>
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
        <a href="/admin/member/write" class="bg-black text-white py-2 px-4 rounded-sm">생성</a>
      </span>
    </nav>
  </div>
</section>