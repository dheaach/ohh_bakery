    

        <form method="POST" name="form-example-1" id="form-example-1" enctype="multipart/form-data">

            <div class="input-field">
                <input type="text" name="name-1" id="name-1">
                <label for="name-1">Name</label>
            </div>

            <div class="input-field">
                <input type="text" name="description-1" id="description-1">
                <label for="description-1">Description</label>
            </div>

            <div class="input-field">
                <label class="active">Photos</label>
                <div class="input-images-1" style="padding-top: .5rem;"></div>
            </div>

            <button>Submit and display data</button>

        </form>


        <h4 id="example-2"><a href="#example-2"># Example 2
            <small>- with options</small>
        </a></h4>

        <form method="POST" name="form-example-2" id="form-example-2" enctype="multipart/form-data">

            <div class="input-field">
                <input type="text" name="name-2" id="name-2" value="John Doe">
                <label for="name-2" class="active">Name</label>
            </div>

            <div class="input-field">
                <input type="text" name="description-2" id="description-2"
                       value="This form is already filed with some data, including images!">
                <label for="description-2" class="active">Description</label>
            </div>

            <div class="input-field">
                <label class="active">Photos</label>
                <div class="input-images-2" style="padding-top: .5rem;"></div>
            </div>

            <button>Submit and display data</button>

        </form>


    <div id="show-submit-data" class="modal" style="visibility: hidden;">
        <div class="content">
            <h4>Submitted data:</h4>
            <p id="display-name"><strong>Name:</strong> <span></span></p>
            <p id="display-description"><strong>Description:</strong> <span></span></p>
            <p><strong>Uploaded images:</strong></p>
            <ul id="display-new-images"></ul>
            <p><strong>Preloaded images:</strong></p>
            <ul id="display-preloaded-images"></ul>
            <a href="javascript:$('#show-submit-data').css('visibility', 'hidden')" class="close"><i
                    class="material-icons">close</i></a>
        </div>
    </div>

<script>
    $(function () {

        $('.input-images-1').imageUploader();

        let preloaded = [
            {id: 1, src: 'https://picsum.photos/500/500?random=1'},
            {id: 2, src: 'https://picsum.photos/500/500?random=2'},
            {id: 3, src: 'https://picsum.photos/500/500?random=3'},
            {id: 4, src: 'https://picsum.photos/500/500?random=4'},
            {id: 5, src: 'https://picsum.photos/500/500?random=5'},
            {id: 6, src: 'https://picsum.photos/500/500?random=6'},
        ];

        $('.input-images-2').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'photos',
            preloadedInputName: 'old'
        });

        $('form').on('submit', function (event) {

            // Stop propagation
            event.preventDefault();
            event.stopPropagation();

            // Get some vars
            let $form = $(this),
                $modal = $('.modal');

            // Set name and description
            $modal.find('#display-name span').text($form.find('input[id^="name"]').val());
            $modal.find('#display-description span').text($form.find('input[id^="description"]').val());

            // Get the input file
            let $inputImages = $form.find('input[name^="images"]');
            if (!$inputImages.length) {
                $inputImages = $form.find('input[name^="photos"]')
            }

            // Get the new files names
            let $fileNames = $('<ul>');
            for (let file of $inputImages.prop('files')) {
                $('<li>', {text: file.name}).appendTo($fileNames);
            }

            // Set the new files names
            $modal.find('#display-new-images').html($fileNames.html());

            // Get the preloaded inputs
            let $inputPreloaded = $form.find('input[name^="old"]');
            if ($inputPreloaded.length) {

                // Get the ids
                let $preloadedIds = $('<ul>');
                for (let iP of $inputPreloaded) {
                    $('<li>', {text: '#' + iP.value}).appendTo($preloadedIds);
                }

                // Show the preloadede info and set the list of ids
                $modal.find('#display-preloaded-images').show().html($preloadedIds.html());

            } else {

                // Hide the preloaded info
                $modal.find('#display-preloaded-images').hide();

            }

            // Show the modal
            $modal.css('visibility', 'visible');
        });

        // Input and label handler
        $('input').on('focus', function () {
            $(this).parent().find('label').addClass('active')
        }).on('blur', function () {
            if ($(this).val() == '') {
                $(this).parent().find('label').removeClass('active');
            }
        });

        // Sticky menu
        let $nav = $('nav'),
            $header = $('header'),
            offset = 4 * parseFloat($('body').css('font-size')),
            scrollTop = $(this).scrollTop();

        // Initial verification
        setNav();

        // Bind scroll
        $(window).on('scroll', function () {
            scrollTop = $(this).scrollTop();
            // Update nav
            setNav();
        });

        function setNav() {
            if (scrollTop > $header.outerHeight()) {
                $nav.css({position: 'fixed', 'top': offset});
            } else {
                $nav.css({position: '', 'top': ''});
            }
        }
    });
</script>
