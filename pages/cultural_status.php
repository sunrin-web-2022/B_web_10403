<div class="border-bottom p-4">
    <div class="container d-flex justify-content-between">
        <h3>무형문화재 현황</h3>
        <p>홈 &gt; 무형문화재 현황</p>
    </div>
</div>
<div class="container">
    <ul class="nav nav-pills m-3 justify-content-end" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="album-tab" data-toggle="pill" href="#album" role="tab">앨범형</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="list-tab" data-toggle="pill" href="#list" role="tab">목록형</a>
        </li>
    </ul>
    <div class="tab-content container" id="pills-tabContent">
        <div class="tab-pane fade show active" id="album" role="tabpanel">
            <div class="row w-100">
            </div>
        </div>
        <div class="tab-pane fade" id="list" role="tabpanel">
            <table class="table table-hover mt-3">
                <thead class="thead-light">
                    <tr>
                        <th>순번</th>
                        <th>명칭</th>
                        <th>소재지</th>
                        <th>종목</th>
                        <th>관리자(단체)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>종묘제례악</td>
                        <td>서울</td>
                        <td>국가무형문화재 제1호</td>
                        <td>(사)국가무형문화재 종묘제례악보존회</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>양주별산대놀이</td>
                        <td>경기 양주시</td>
                        <td>국가무형문화재 제2호</td>
                        <td>(사)국가무형문화재 제2호 양주별산대놀이보존회</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>남사당놀이</td>
                        <td>서울</td>
                        <td>국가무형문화재 제3호</td>
                        <td>남사당놀이보존회</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>갓일</td>
                        <td>기타</td>
                        <td>국가무형문화재 제4호</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>판소리</td>
                        <td>기타</td>
                        <td>국가무형문화재 제5호</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>통영오광대</td>
                        <td>경남 통영시</td>
                        <td>국가무형문화재 제6호</td>
                        <td>(사)국가무형문화재 제6호 통영오광대보존회</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>고성오광대</td>
                        <td>경남 고성군</td>
                        <td>국가무형문화재 제7호</td>
                        <td>(사)국가무형문화재 제7호 고성오광대보존회</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>강강술래</td>
                        <td>전남 진도군</td>
                        <td>국가무형문화재 제8호</td>
                        <td>(사)국가무형문화재 강강술래보존회</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>은산별신제</td>
                        <td>충남 부여군</td>
                        <td>국가무형문화재 제9호</td>
                        <td>(사)국가무형문화재 은산별신제</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>나전장</td>
                        <td>강원 원주시</td>
                        <td>국가무형문화재 제10호</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center" id="cultural-pagination">
            </ul>
        </nav>
    </div>
</div>
<script>
    let totalCnt = -1;
    let currentPageIndex = 1;
    let finalPageIndex = -1;

    $("html").ready(function() {
        selectIndex(1);
    });

    function selectIndex(obj) {
        let str = "";
        let index = -1;

        if (typeof obj == "object") {
            str = $(obj).text();
        } else {
            str = obj;
        }

        if (parseInt(str)) {
            index = parseInt(str);
        }

        switch (str) {
            case "<<":
                currentPageIndex = 1;
                break;
            case "<":
                if (currentPageIndex - 1 >= 1) {
                    currentPageIndex--;
                }
                break;
            case ">":
                if (currentPageIndex + 1 <= finalPageIndex) {
                    currentPageIndex++;
                }
                break;
            case ">>":
                currentPageIndex = finalPageIndex;
                break;
            default:
                currentPageIndex = index;
                break;
        }

        let tmp_i = 0;

        if (currentPageIndex - 5 < 0) {
            tmp_i = 1;
        } else if (currentPageIndex - 5 >= 0 && currentPageIndex + 5 <= finalPageIndex) {
            tmp_i = currentPageIndex - 4;
        } else if (currentPageIndex + 5 > finalPageIndex) {
            tmp_i = finalPageIndex - 8;
        }

        $("#cultural-pagination li").remove();

        let parent = $("#cultural-pagination");

        obj = $(`
        <li class="page-item">
            <a class="page-link" onclick="selectIndex(this)">&lt;&lt;</a>
        </li>
        <li class="page-item">
            <a class="page-link" onclick="selectIndex(this)">&lt;</a>
        </li>
        `);

        parent.append(obj);

        for (let i = tmp_i; i < tmp_i + 9; i++) {
            obj = $(`
            <li class="page-item">
            <a class="page-link" onclick="selectIndex(this)">${ i }</a>
            </li>
            `);

            if (i == currentPageIndex) {
                obj.addClass("active");
            }

            parent.append(obj);

        }

        obj = $(`
        <li class="page-item">
            <a class="page-link" onclick="selectIndex(this)">&gt;</a>
        </li>
        <li class="page-item">
            <a class="page-link" onclick="selectIndex(this)">&gt;&gt;</a>
        </li>
        `);

        parent.append(obj);
        updateLayout();
    }

    function updateLayout() {
        $.ajax({
            type: "POST",
            url: "xml/nihList.xml",
            dataType: "xml",
            cache: false,
            async: false,
            success: function(response) {
                response = $(response);

                totalCnt = parseInt(response.find("totalCnt").text());
                finalPageIndex = parseInt(totalCnt / 8) + 1;

                let items = response.find("item");

                $("#album .row .col-3").remove();
                let parent = $("#album .row");
                for (let i = (currentPageIndex - 1) * 8; i < currentPageIndex * 8; i++) {
                    if (i > totalCnt - 1) {
                        break;
                    }
                    let item = $(items[i]);
                    let ccbaMnm1 = item.find("ccbaMnm1").text();
                    let ccbaKdcd = item.find("ccbaKdcd").text();
                    let ccbaCtcd = item.find("ccbaCtcd").text();
                    let ccbaAsno = item.find("ccbaAsno").text();
                    let imgUrl = "";

                    $.ajax({
                        type: "POST",
                        url: `xml/detail/${ccbaKdcd}_${ccbaCtcd}_${ccbaAsno}.xml`,
                        dataType: "xml",
                        cache: false,
                        async: false,
                        success: function(response) {
                            imgUrl = $(response).find("imageUrl").text();
                        }
                    });

                    let obj = "";
                    if (!imgUrl) {
                        obj = $(`
                    <div class="col-3 my-3">
                        <div class="card text-center bg-transparent">
                            <div class="w-100 border-bottom card-custom-img position-relative" style="height: 180px;><p class="h-100 m-auto">no image</p></div>
                            <div class="card-body">
                                <h5 class="card-title pb-1 m-0">${ ccbaMnm1 }</h5>
                            </div>
                        </div>
                    </div>
                    `);
                    } else {
                        obj = $(`
                    <div class="col-3 my-3">
                        <div class="card text-center bg-transparent">
                            <div class="w-100 border-bottom card-custom-img position-relative" style="height: 180px; background: url(xml/nihcImage/${ imgUrl }); background-size: cover; background-position: center center;"></div>
                            <div class="card-body">
                                <h5 class="card-title pb-1 m-0">${ ccbaMnm1 }</h5>
                            </div>
                        </div>
                    </div>
                    `);
                    }

                    parent.append(obj);



                }
            }
        });
    }
</script>