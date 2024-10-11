function userLoggedIn(id){
    let user = document.querySelector(".user-btn")
    let buttons = document.querySelector(".nav-button")
    console.log(id);
    if (id !== null){
        buttons.style.display = 'none';
        user.style.display = 'block';
    } else {
        buttons.style.display = 'flex';
        user.style.display = 'none';
    }
}


function activePage(){
    var currentPath = window.location.pathname;
            var currentPage = currentPath.substring(currentPath.lastIndexOf('/') + 1);

            $('nav a').each(function(){
                var pageLink = $(this).attr('href');

                if (pageLink === currentPage){
                    $(this).addClass('active');
                }
            })
}

function loadBlogs() {
    var search_value = $('#search_value').val().toLowerCase();
    $.ajax({
        url: "db/request.php",
        method: "POST",
        data: {
            "get_blogs": true,
        },
        success: function(result) {
            var tBody = ``;
            var datas = JSON.parse(result);
            datas.forEach(function(data) {
                if(data['title'].toLowerCase().includes(search_value)){
                    tBody += `<tr>`;
                        tBody += `<td>${data['title']}</td>`;
                        tBody += `<td>${data['category']}</td>`;
                        tBody += `<td><image src="${data['img']}" height="100px"></td>`;
                        tBody += `<td>${data['content']}</td>`;
                        tBody += `<td>${data['author']}</td>`;
                        tBody += `<td>${data['date_added']}</td>`;
                        tBody += `<td>${data['date_modified']}</td>`;
                        tBody += `<td>
                            <button type="button" class="btn btn-info btn-update" data-toggle="modal" data-target="#updateModal" data-id="${data['id']}"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="${data['id']}"><i class="fas fa-trash-alt"></i></button>
                            </td>`;
                    tBody += `</tr>`;
                }
            });
            $('#tBodyBlog').html(tBody);
        },
        error: function(error) {
            alert("Something went wrong!");
        }
    });
}

function displayBlogs(num =  null, category="all"){
    var search_value = $('#search_value').val().toLowerCase();
    $.ajax({
        url: "db/request.php",
        method: "POST",
        data: {
            "get_blogs": true,
            "category": category,
        },
        success: function(result) {
            var date = ``;
            var bCard = ``;
            var cnt = 0;
            var datas = JSON.parse(result);
            datas.forEach(function(data) {
                date = data['date_modified'] !== '0000-00-00' ? data['date_modified'] : data['date_added'];
                if(data['title'].toLowerCase().includes(search_value)){
                    if (num !== null && cnt >= num) return;
                        bCard += `<div class="post-box">`;
                            bCard += `<img src="${data['img']}" class="post-img">`;
                            bCard += `<h2 class="category">${data['category']}</h2>`;
                            bCard += `<p class="post-title">${data['title']}</p>`;
                            bCard += `<span class="post-date">${date}</span>`;
                            bCard += `<p class="post-description">${data['content']}</p>`;
                            bCard += `<div class="button">`;
                                bCard += `<a href="blog_content.php?blogId=${data['id']}" class="btn-read-more">Read More</a>`;
                            bCard += `</div>`;
                        bCard += `</div>`;
                    cnt++;
                    }
                
            });
            $('#postContainer').html(bCard);
        },
        error: function(error) {
            alert("Something went wrong!");
        }
    });
}



function showBlog(id) {
    $.ajax({
        url: "db/request.php",
        method: "POST",
        data: {
            "get_blogs": true,
            "id": id,
        },
        success: function(result) {
            var datas = JSON.parse(result);
            var data = datas[0];
            let title = `${data['title']}`;
            let img = `${data['img']}`;
            let content = `${data['content']}`;
            let category = `${data['category']}`;
            $('#category option').each(function() {
                if ($(this).val() === category) {
                    $(this).prop('selected', true);
                }
            })
            console.log(category);
            $('#title').val(title);
            $('#preview_old').attr('src', img);
            $('#content').val(content);
        },
        error: function(error) {
            alert("Something went wrong!");
        }
    });
}

function displayComments(id){
    $.ajax({
        url: "db/request.php",
        method: "POST",
        data: {
            "get_comments": true,
            "id": id,
        },
        success: function(result) {
            var comment = ``;
            var datas = JSON.parse(result);
            datas.forEach(function(data) {
                comment += `
                    <div class="comment">
                        <p>
                            <strong>${data['username']}</strong><br>
                            <span class="comment-date">${data['date']}</span><br><br>
                            ${data['comment']}
                        </p>
                    </div>`;
            });
            $('#comment').html(comment);
        },
        error: function(error) {
            alert("Something went wrong!");
        }
    });
}

