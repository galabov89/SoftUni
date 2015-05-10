var choice = '';

function ConfirmDelete( title, choice){

    if(true) {
        var n = noty({
            text: 'Are you sure you want to delete post number: '+title,
            type: 'confirm',
            dismissQueue: false,
            layout: 'topCenter',
            theme: 'defaultTheme',
            buttons: [
                {addClass: 'btn btn-primary', text: 'Yes', onClick: function($noty) {

                    choice = 'positive';
                    $noty.close();
                    noty(
                        {
                            text: 'You clicked "Ok" button',
                            type: 'success',
                            timeout: 5000
                        });
                }
                },
                {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {

                    choice = 'negative';
                    $noty.close();
                    noty(
                        {
                            text: 'You clicked "Cancel" button',
                            type: 'error',
                            timeout: 5000
                        });
                }
                }
            ]


        })
    }

    return choice;

}

var name = ConfirmDelete( title, choice);






