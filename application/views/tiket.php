<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ticket/style.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <title>Tiket</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Aplikasi Ticket</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('index.php/logout'); ?>">Logout</a>
            </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="ticket-box">
                <div class="form-group">
                    <label for="ticket">Masukkan nomor tiket:</label>
                    <input type="number" class="form-control" id="ticket">
                </div>
                <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <div class="row">
            <div class="alert-box space">
                <div class="alert alert-danger">
                    Tiket tidak ditemukan, silahkan input kembali.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="detail-box">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No. Tiket</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="no_tiket"></td>
                        <td class="deskripsi"></td>
                        <td class="status"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let BASE_URL = "<?php echo base_url();?>index.php";
            $("#submit").click(function (e) {
                let ticketNum = $("#ticket").val();
                $.get(BASE_URL + "/tiket/get_tiket", {
                    no_tiket: ticketNum
                },
                function (results, status) {
                    if (results.data.length>0) {
                        
                        $(".row .alert-box").css("visibility", "hidden");
                        $(".no_tiket").html(results.data[0].no_ticket);
                        $(".deskripsi").html(results.data[0].deskripsi);
                        $(".status").html(results.data[0].status);
                        $(".row .detail-box").css("visibility", "visible");
                    }
                    else {
                        $(".row .detail-box").css("visibility", "hidden");
                        $(".row .alert-box").css("visibility", "visible");
                    }
                });
            });
        });
    </script>
</body>
</html>