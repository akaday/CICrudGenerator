function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_lama1').hide();
                    $('#image_baru1').show();
                    $('#image_baru1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_lama2').hide();
                    $('#image_baru2').show();
                    $('#image_baru2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_lama3').hide();
                    $('#image_baru3').show();
                    $('#image_baru3').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_lama4').hide();
                    $('#image_baru4').show();
                    $('#image_baru4').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }