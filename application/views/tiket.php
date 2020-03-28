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
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <a class="navbar-brand" href="<?php echo base_url('index.php/tiket'); ?>">Aplikasi Ticket</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('index.php/tiket'); ?>">Input Ticket</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('index.php/profile'); ?>">My Profile</a>
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
                <button id="submit" type="submit" class="btn btn-danger">Submit</button>
            </div>
        </div>
        <div class="row">
            <div class="alert-box space">
                <div id="textMessage" class="alert alert-danger">
                    <!-- Tiket tidak ditemukan, silahkan input kembali. -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="detail-box">
                <div style="padding-bottom: 30px;">
                    <center>
                        <h5>Masukkan Data Dibawah Ini</h5>
                    </center>
                </div>
                    <div class="row">
                        <div class="alert-list space">
                            <div id="alert-list" class="alert alert-danger">
                            </div>
                        </div>
                    </div>
                <div class="form-group">
                    <label for="no_ticket">No. Tiket:</label>
                    <input type="text" class="form-control" id="no_ticket" disabled>
                </div>
                <div class="form-group">
                    <label for="no_internet">No. Internet:</label>
                    <input type="text" class="form-control" id="no_internet" disabled>
                </div>
                <div class="form-group">
                    <label for="service">Service:</label>
                    <input type="text" class="form-control" id="service" disabled>
                </div>
                <div class="form-group">
                    <label for="jenis_ont">Jenis Ont:</label>
                    <input type="text" class="form-control" id="jenis_ont">
                </div>
                <div class="form-group">
                    <label for="type_ont">Type Ont:</label>
                    <input type="text" class="form-control" id="type_ont">
                </div>
                <div class="form-group">
                    <label for="actual_solution">Actual Solution:</label>
                    <input type="text" class="form-control" id="actual_solution">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" class="form-control" id="keterangan">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status">
                        <option>Dispatch</option>
                        <option>Close</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="loker_awal">Loker Awal:</label>
                    <input type="text" class="form-control" id="loker_awal" value="ROC" disabled>
                </div>
                <div class="form-group">
                    <label for="resolved">Resolved:</label>
                    <input type="text" class="form-control" id="resolved" value="ROC" disabled>
                </div>
                <div class="form-group">
                    <label for="agent">Agent:</label>
                    <input type="text" class="form-control" id="agent" disabled>
                </div>
                <button id="simpan" type="submit" class="btn btn-danger">Simpan</button>
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
                    if (results.status===200) {
                        $(".row .alert-box").css("visibility", "hidden");
                        $("#no_ticket").val(results.data[0].no_ticket);
                        $("#no_internet").val(results.data[0].no_internet);
                        $("#service").val(results.data[0].service);
                        $("#agent").val(results.data[0].agent);
                        $(".row .detail-box").css("visibility", "visible");
                    }
                    else {
                        $(".row .detail-box").css("visibility", "hidden");
                        $("#textMessage").empty();
                        $("#textMessage").append(results.message);
                        $(".row .alert-box").css("visibility", "visible");
                    }
                });
            });
            $("#simpan").click(function (e) { 
                let no_tiket = $("#ticket").val();
                let no_internet = $("#no_internet").val();
                let service = $("#service").val();
                let jenis_ont = $("#jenis_ont").val();
                let type_ont = $("#type_ont").val();
                let actual_solution = $("#actual_solution").val();
                let keterangan = $("#keterangan").val();
                let status = $("#status").val();
                let loker_awal = $("#loker_awal").val();
                let resolved = $("#resolved").val();
                let agent = $("#agent").val();
                $.post(BASE_URL + "/tiket/proccess_tiket", {
                    no_tiket,
                    no_internet,
                    service,
                    jenis_ont,
                    type_ont,
                    actual_solution,
                    keterangan,
                    status,
                    loker_awal,
                    resolved,
                    agent
                },
                function (data) {
                    if (data.status==200) {
                        alert('Submit tiket anda berhasil!');
                        location.href = BASE_URL;
                    }
                    else {
                        let errorMessage = Object.values(data.message);
                        $(".row .alert-list").css("visibility", "visible");
                        $("#alert-list").empty();
                        $("#alert-list").append('<ul>');
                        errorMessage.forEach(message => {
                            $("#alert-list").append(`<li>${message}</li>`);
                        });
                        $("#alert-list").append('</ul>');
                    }
                });
            });
        });
    </script>
</body>
</html>