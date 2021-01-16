
document.addEventListener("DOMContentLoaded", function () {
    //const input = document.querySelector('searchReview')
    //const log = document.getElementById('searchReview');



   document.getElementById('searchReview').addEventListener('keyup', filterReviews);
});


function filterReviews() {
    var x = document.getElementById('searchReview');

    let vstup = x.value;
    console.log("Vystup je: \"" + x.value+ "\"");

    $.ajax({
        url: '/review/filter/',
        data: {
            vstup:vstup,
        },
        success: function (response) {
            if (response) {
                newHTML = '';
                response.reviews.forEach(review => {
                    var editURL = '/review/'+review.id+'/edit'
                    newHTML += '<div class="card review col-12">\n' +
                        '                <div class="row my-auto">\n' +
                        '                    <div class="col-10 my-auto">\n' +
                        '                        <strong>' + review.movie.nazov + '</strong>\n' +
                        '                    </div>\n'
                    if (review.user_id == response.user.id || response.user.role == 'admin'){
                        newHTML += '                        <div class="upravovanieMazanie text-right my-auto col-2">\n' +
                            '                            <a href=" ' + editURL + ' "\n' +
                            '                               class=" m-1 btn btn-dark" role="button">\n' +
                            '                                <svg xmlns="http://www.w3.org/2000/svg" width="16"\n' +
                            '                                     height="16" fill="currentColor"\n' +
                            '                                     class="bi bi-pencil-fill" viewBox="0 0 16 16">\n' +
                            '                                    <path\n' +
                            '                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>\n' +
                            '                                </svg>\n' +
                            '                            </a>\n' +
                            '\n' +
                            '                            <input type="button" class="deleteReviewButton" id="' + review.id + '" >\n' +
                            '                        </div>\n' +
                            // '                    @endif\n' +
                            '                </div>\n' +
                            '           </div>'
                    } else {
                        newHTML += '</div> </div>'
                    }
                })
                document.getElementById('reviewList').innerHTML=newHTML;
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
        }
    });
}


