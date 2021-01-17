document.addEventListener("DOMContentLoaded", function () {
    //const input = document.querySelector('searchReview')
    //const log = document.getElementById('searchReview');

    var buttons = document.getElementsByClassName('deleteReviewButton');

    for (var i = 0; i < buttons.length; i++) {
        (function () {
            var id = buttons[i].id;
            buttons[i].addEventListener("click", () => {
                deleteReview(id);
            });
        })();
    }
    document.getElementById('searchReview').addEventListener('keyup', filterReviews);
});


function deleteReview(id) {
    if (confirm("Chces naozaj odstranit tuto recenziu? " + id)) {
        $.ajax({
            url: '/review/' + id + '/destroy',
            success: function (response) {
                if (response) {
                    listFilteredReviews(response);
                }
            }
        });
    }
}

function filterReviews() {
    var x = document.getElementById('searchReview');

    let vstup = x.value;
    console.log("Vystup je: \"" + vstup + "\"");

    $.ajax({
        url: '/review/filter/',
        data: {
            vstup: vstup,
        },
        success: function (response) {
            if (response) {
                listFilteredReviews(response);
            }
        }
    });
}

function listFilteredReviews(response) {
    newHTML = '';
    response.reviews.forEach(review => {
        var editURL = '/review/' + review.id + '/edit'
        var destroyURL = '/review/' + review.id + '/destroy'
        newHTML += '<div class="card highlighted review ">\n' +
            '                    <div class="card-header" id="heading' + review.id + '">\n' +
            '                        <h2 class="mb-0">\n' +
            '                            <button class="btn collapsed btn-review btn-link btn-block text-left" type="button"\n' +
            '                                    data-toggle="collapse" data-target="#collapse' + review.id + '"\n' +
            '                                    aria-expanded="false" aria-controls="collapse' + review.id + '">\n' +
            '                                <div class="row my-auto">\n' +
            '                                    <div class="review-list-user my-auto col-3">' + review.user.name + '</div>\n' +
            '                                    <div class="review-list-user my-auto col-4">' + review.movie.nazov + '</div>\n' +
            '                                    <div class="review-list-movie my-auto  ">' + review.hodnotenie + ' / 5</div>\n' +
            '                                </div>\n' +
            '                            </button>\n' +
            '                        </h2>\n' +
            '                    </div>\n' +
            '\n' +
            '                    <div id="collapse' + review.id + '" class="collapse" aria-labelledby="headingOne"\n' +
            '                         data-parent="#reviewList">\n' +
            '                        <div class="card-body">\n' +
            '                            ' + review.popis + ''
        if (response.user != null && (review.user_id == response.user.id || response.user.role == 'admin')) {
            newHTML += '<div class="upravovanieMazanie text-right   ">\n' +
                '                                    <a href=" ' + editURL + '"\n' +
                '                                       class=" m-1 btn btn-dark" role="button">\n' +
                '                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"\n' +
                '                                             height="16" fill="currentColor"\n' +
                '                                             class="bi bi-pencil-fill" viewBox="0 0 16 16">\n' +
                '                                            <path\n' +
                '                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>\n' +
                '                                        </svg>\n' +
                '                                    </a>\n' +
                ' <button type="button" role="button" class="btn btn-dark deleteReviewButton" id="'+review.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="16"\n' +
                '                                                                                                                       height="16" fill="currentColor"\n' +
                '                                                                                                                       class="bi bi-trash-fill" viewBox="0 0 16 16">\n' +
                '                                            <path\n' +
                '                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>\n' +
                '                                        </svg>\n' +
                '                                    </button>' +
                '                                </div>' +
                ' </div> </div> </div>'
        } else {
            newHTML += ' </div> </div> </div>'
        }
    })
    document.getElementById('reviewList').innerHTML = newHTML;
    var buttons = document.getElementsByClassName('deleteReviewButton');

    for (var i = 0; i < buttons.length; i++) {
        (function () {
            var id = buttons[i].id;
            buttons[i].addEventListener("click", () => {
                deleteReview(id);
            });
        })();
    }
}


