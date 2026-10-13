</div>
{{-- <button class="btn btn-dark btn-icon" id="back-to-top">
    <i class="bi bi-caret-up fs-3xl"></i>
</button> --}}

<script src="{{ asset('franchise_assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('franchise_assets/js/app.min.js') }}"></script>

<!-- Datatables js -->
<script src="{{ asset('franchise_assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('franchise_assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('franchise_assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('franchise_assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable Init js -->
<script src="{{ asset('franchise_assets/js/pages/demo.datatable-init.js') }}"></script>

<!-- third party js -->
<script src="{{ asset('franchise_assets/js/vendor/apexcharts.min.js') }}"></script>
<script src="{{ asset('franchise_assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('franchise_assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="{{ asset('franchise_assets/js/pages/demo.dashboard.js') }}"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/ie7/ie7.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    new DataTable('#example');
    CartQty();

    // function CartQty() {
    //     (document.querySelector(".hamburger-icon").classList.remove("open"))
    //     $('#CartQty')
    //         .html('<i class="fa fa-spin fa-spinner" style="font-size:10px !important"></i>').load(
    //             "services/CartQty.ashx");
    // }

    function cLogout() {
        $('#logoutModal').modal('show');
    }

    function logout() {
        window.location.href = '/uLogout';
    }
</script>

<script>
    $(document).ready(function() {
        //$("#offerModal").modal("show");
        $("#NewsId").html("<i class='fa fa-spinner fa-spin'></i> fetching news..").load(
            "services/GetNews.ashx");
        $("#spnNotice").html("<i class='fa fa-spinner fa-spin'></i> fetching news..").load(
            "services/GetUserNews.ashx");
    });

    $('#req_amount').on('input', function() {
        var amount = parseInt($('#req_amount').val());
        $('#fund').html('₹ ' + amount.toFixed(2));
    });

    $('#type').on('change', function() {
        var wallet_type = $(this).val();
        var wallet = {{$data['wallet']}};
        var p2p_wallet = {{$data['p2p_wallet']}};

        if (wallet_type == 'p2p_wallet') {
            amount = p2p_wallet;
        } else {
            amount = wallet;
        }

        $('#fund_type').html(amount);

    });

    $('#fundmemberid').on('input', function() {
        var memberid = $(this).val();
        var csrf = $('#csrf').val();
        if (memberid.length == 0) {
            $('#memMsg').html('');
            $('#transBtn').attr('disabled', false);
        }
        $.ajax({
            url: '/getMember',
            type: 'POST',
            data: {
                'memberid': memberid,
                _token: csrf,
            },
            success: function(response) {
                $('#memMsg').html(response['data']);
                if (response['code'] == 0) {
                    $('#transBtn').attr('disabled', true);
                } else {
                    $('#transBtn').attr('disabled', false);
                }
            }
        });
    });

    $('#ecommers').on('change', function() {
        var ecommers = $(this).val();
        if (ecommers == '') {
            return alert('Please select plateform');
        }
        $.ajax({
            url: '{{ route('getProducts') }}',
            type: 'POST',
            data: {
                'ecommers': ecommers,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                $('#product').html(response['data']);
            }
        });
    });
    
     $('#club').on('change', function() {
        var value = $(this).val();
        var memberid = '{{ $data['memberid'] }}';
        $('#value').html(value);
        window.location.href = '{{ url("member/club/club-details") }}/' + value;

    });

    $('#club_no').on('change', function() {
        var value = $(this).val();
        var memberid = '{{ $data['memberid'] }}';
        $('#value').html(value);
        window.location.href = '{{ url('member/club/club-members') }}/' + value;

    });

    //referal link
    $('#copyButtonId').on('click', function() {
        var text = $('#code').text()
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
        $('#msgText').html('Text Copied');
        $('#rcode').show().delay(3000).fadeOut();
    });

    $("#amount").on("input", function() {
        var amount = $(this).val();
        var wallet = $("#wallet").val();
        var minActivationAmount = 1000;
        var maxActivationAmount = 10000;
        
        if (amount.length == 0) {
            $('#amountHtml').html('');
            return;
        }
        
        amount = parseInt(amount);
        
        if (amount > parseInt(wallet)) {
            $("#amountHtml").html("*** Insufficient wallet balance for activation");
        } else if (amount < minActivationAmount) {
            $("#amountHtml").html("*** Activation amount must be at least " + minActivationAmount + " BV");
        } else if (amount > maxActivationAmount) {
            $("#amountHtml").html("*** Activation amount cannot exceed " + maxActivationAmount + " BV");
        } else {
            $("#amountHtml").html("");
        }
    });

    // $("#amount").on("input", function() {
    //     var amount = $(this).val();
    //     var wallet = $("#wallet").val();
    //     if (amount.length == 0) {
    //         $('#amountHtml').html('');
    //     }
    //     if (amount > parseInt(wallet)) {
    //         $("#amountHtml").html("*** This BV amount is not allowed");
    //     } else if (amount < 1000 && amount > 0) {
    //         $("#amountHtml").html("*** BV Amount must be equal or greater than 1000 BV");
    //     } else if (amount % 10 != 0) {
    //         $("#amountHtml").html("*** BV Amount must be multiple of 10 BV");
    //     } else {
    //         $("#amountHtml").html("");
    //     }
    // });

    $('#formSub').on('submit', function() {
        $('#subBtn').html('Processing....');
        $('#subBtn').prop('disabled', true);
    });

    function ShowBussiness() {
        $('#BussId').html("<i class='fa fa-spinner fa-spin'></i>").load("services/getDailyBussiness.ashx");
        $('#myModal').modal('show');
    }

    function ShowEarning() {
        $('#EarningId').html("<i class='fa fa-spinner fa-spin'></i>").load("services/getDailyEarning.ashx");
        $('#myModal2').modal('show');
    }

    function ShowNominee() {
        $('#NomineeId').html("<i class='fa fa-spinner fa-spin'></i>").load("services/getNominee.ashx");
        $('#myModal3').modal('show');
    }

</script>

<script type="text/javascript">
    var SelectedRadioButtonValue = 0;
    var EmailIDForPromotion = '',
        MobileForPromotion = '';
    var side = '';
    $(document).ready(function() {
        //BindStatistics();

        var isMobile = {

            Android: function() {

                return navigator.userAgent.match(/Android/i);

            },

            BlackBerry: function() {

                return navigator.userAgent.match(/BlackBerry/i);

            },

            iOS: function() {

                return navigator.userAgent.match(/iPhone|iPad|iPod/i);

            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile
                    .Opera() || isMobile.Windows());
            }
        };

        $(document).on("click", '#whatsapp', function() {
            if (isMobile.any()) {
                var text = $(this).attr("data-text");
                var url = $(this).attr("data-link");
                var message = encodeURIComponent(text) + " - " + encodeURIComponent(url);
                var whatsapp_url = "whatsapp://send?text=" + message;
                window.location.href = whatsapp_url;
            } else {
                toastr.error("Share on Whatsapp Only Possible In Mobile Device.")
            }
        });


        document.getElementById("btnCopy").addEventListener("click", function() {
            copyToClipboard(document.getElementById("copyTarget"));
            toastr('Group A referral link copied successfully.', 's');
        });

        $(document).on("click", '#whatsapp1', function() {
            if (isMobile.any()) {
                var text = $(this).attr("data-text");
                var url = $(this).attr("data-link");
                var message = encodeURIComponent(text) + " - " + encodeURIComponent(url);
                var whatsapp_url = "whatsapp://send?text=" + message;
                window.location.href = whatsapp_url;
            } else {
                toastr.error("Share on Whatsapp Only Possible In Mobile Device.")
            }
        });
        document.getElementById("btnCopy1").addEventListener("click", function() {
            copyToClipboard(document.getElementById("copyTarget1"));
            toastr('Group B referral link copied successfully.', 's');
        });
    });

    function copyToClipboard(elem) {
        // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch (e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    }
</script>

<footer class="footer">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-sm-12" style="color:black;">
                <script>
                    document.write(new Date().getFullYear())
                </script>
                © {{ config('detailsApp.name') }}
            </div>
        </div>
    </div>
</footer>
</body>

</html>
