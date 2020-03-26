<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/profile/style.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <title>My Profile</title>
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
            <div class="alert-box space">
                <div class="alert alert-info">
                    Tidak ada data tiket yang telah diinput.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="detail-box">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No. Tiket</th>
                        <th scope="col">No. Internet</th>
                        <th scope="col">Service</th>
                        <th scope="col">Jenis Ont</th>
                        <th scope="col">Type Ont</th>
                        <th scope="col">Actual Solution</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Loker Awal</th>
                        <th scope="col">Resolved</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Tanggal Submit</th>
                        </tr>
                    </thead>
                    <tbody id="listTiket">
                        <!-- <tr>
                        <td class="no_tiket"></td>
                        <td class="deskripsi"></td>
                        <td class="status"></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let BASE_URL = "<?php echo base_url();?>index.php";
            let ticketNum = $("#ticket").val();
            $.get(BASE_URL + "/tiket/get_tiket",
            function (results, status) {
                if (results.data.length>0) {
                    $(".row .alert-box").css("visibility", "hidden");
                    results.data.forEach(tiket => {
                        $("#listTiket").append("<tr>");
                        $("#listTiket").append(`<td>${tiket.no_ticket}</td>`);
                        $("#listTiket").append(`<td>${tiket.no_internet}</td>`);
                        $("#listTiket").append(`<td>${tiket.service}</td>`);
                        $("#listTiket").append(`<td>${tiket.jenis_ont}</td>`);
                        $("#listTiket").append(`<td>${tiket.type_ont}</td>`);
                        $("#listTiket").append(`<td>${tiket.actual_solution}</td>`);
                        $("#listTiket").append(`<td>${tiket.keterangan}</td>`);
                        $("#listTiket").append(`<td>${tiket.status}</td>`);
                        $("#listTiket").append(`<td>${tiket.loker_awal}</td>`);
                        $("#listTiket").append(`<td>${tiket.resolved}</td>`);
                        $("#listTiket").append(`<td>${tiket.agent}</td>`);
                        $("#listTiket").append(`<td>${tiket.created_at}</td>`);
                        $("#listTiket").append("</tr>");    
                    });
                    $(".row .detail-box").css("visibility", "visible");
                }
                else {
                    $(".row .detail-box").css("visibility", "hidden");
                    $(".row .alert-box").css("visibility", "visible");
                }
            });
            
        });
    </script>
</body>
</html>