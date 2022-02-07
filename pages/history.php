<div class="border-bottom p-4">
    <div class="container d-flex justify-content-between">
        <h3>연혁</h3>
        <p>홈 &gt; 일반현황 &gt; 연혁</p>
    </div>

</div>
<div class="container">
    <button class="btn btn-primary float-right m-3" type="button" onclick="historyInsertModal()">연혁 추가</button>
    <div class="container mb-3">
        <ul class="nav nav-pills nav-justified w-100 my-3" id="history-pills">
        </ul>
        <div class="row">
            <div class="tab-content col-8" id="history-contents">
            </div>
            <div class="col-4">
                <img src="resources/images/popup/popup1.png" class="w-100 h-100">
            </div>
        </div>


    </div>
</div>

<div id="history-insert-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="history-insert-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="history-insert-modal-title">연혁 추가</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="history-insert-title">내용</label>
                    <input id="history-insert-title" class="form-control" type="text" name="history-insert-title">
                </div>
                <div class="form-group">
                    <label for="history-insert-date">날짜</label>
                    <input id="history-insert-date" class="form-control" type="date" name="history-insert-date">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" onclick="historyInsertModal()">취소</button>
                <button class="btn btn-primary" type="button" onclick="historyInsert()">추가</button>
            </div>
        </div>
    </div>
</div>

<div id="history-update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="history-update-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="history-update-modal-title">연혁 수정</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="history-update-id" type="hidden" name="history-update-id" value="-1">
                <div class="form-group">
                    <label for="history-update-title">내용</label>
                    <input id="history-update-title" class="form-control" type="text" name="history-update-title">
                </div>
                <div class="form-group">
                    <label for="history-update-date">날짜</label>
                    <input id="history-update-date" class="form-control" type="date" name="history-update-date">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" onclick="historyUpdateModal()">취소</button>
                <button class="btn btn-primary" type="button" onclick="historyUpdate()">수정</button>
            </div>
        </div>
    </div>
</div>
<script>
    let historyData = [];
    let latestId = -1;

    $("html").ready(function() {
        historyData = JSON.parse(localStorage.getItem("historyData"));

        if (Array.isArray(historyData)) {
            historyData.forEach(e => {
                if (latestId < e.id) {
                    latestId = e.id;
                }
            })
            updateLayout();
        } else {
            historyData = [];
        }
    });

    function historyInsertModal() {
        $("#history-insert-modal").modal("toggle");
    }

    function historyUpdateModal(obj) {
        if (obj) {
            let id = $(obj).parent().parent().data("id");

            let index = historyIndex(id);
            let data = historyData[index];

            $("#history-update-id").val(data.id);
            $("#history-update-title").val(data.title);
            $("#history-update-date").val(data.date);
        }

        $("#history-update-modal").modal("toggle");
    }

    function historyIndex(id) {
        return historyData.findIndex(e => {
            if (e.id == id) {
                return 1;
            }
        });
    }

    function historyInsert() {
        let title = $("#history-insert-title").val();
        let date = $("#history-insert-date").val();

        if (!title || !date) {
            alert("내용을 채워주세요");
        } else {
            historyData.push({
                date,
                title,
                id: ++latestId
            })

            historySave();
        }

    }

    function historyUpdate() {
        let id = $("#history-update-id").val();
        let title = $("#history-update-title").val();
        let date = $("#history-update-date").val();
        let index = historyIndex(id);

        historyData[index].title = title;
        historyData[index].date = date;

        historySave();
    }

    function historyDelete(obj) {
        let id = $(obj).parent().parent().data("id");
        if (window.confirm("정말로 삭제하시겠습니까?")) {
            let currentIndex = historyIndex(id);

            historyData.splice(currentIndex, 1);
            historySave();
        }
    }

    function historySave() {
        historyData.sort((a, b) => {
            if (a.date > b.date) {
                return -1
            } else if (a.date <= b.date) {
                return 1;
            }
            return 0;
        });
        localStorage.setItem("historyData", JSON.stringify(historyData));
        location.href = "history";
    }

    function updateLayout() {
        historyData.forEach(e => {
            let currentYear = e.date.split("-")[0];
            let parent = $(`#history-${currentYear}`);

            if (!parent.html()) {
                parent = $("#history-pills");
                let is_firstItem = false;

                if (!parent.find("li").html()) {
                    is_firstItem = true;
                }

                let obj = $(`
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#history-${currentYear}">${currentYear}</a>
                </li>
                `);

                if (is_firstItem) {
                    obj.find("a").addClass("active");
                }

                parent.append(obj);

                parent = $("#history-contents");

                obj = $(`
                <div class="tab-pane fade" id="history-${currentYear}">
                    <table class="table table-light">
                        <tbody>
                        </tbody>
                    </table>
                </div>
                `);

                if (is_firstItem) {
                    obj.addClass("show active");
                }

                parent.append(obj);
            }
            parent = $(`#history-${currentYear}`).find("tbody");

            let obj = $(`
                <tr data-id="${e.id}">
                    <td>${e.date}</td>
                    <td>${e.title}</td>
                    <td class="d-flex justify-content-end">
                        <button class="btn btn-primary mr-1" type="button" onclick="historyUpdateModal(this)">수정</button>
                        <button class="btn btn-danger" type="button" onclick="historyDelete(this)">삭제</button>
                    </td>
                </tr>
            `);

            parent.append(obj);
        });
    }
</script>