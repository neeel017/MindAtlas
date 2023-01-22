<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Enrolment Detail</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">

                    <span class="fs-4">Mind Atlas</span>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 text-dark text-decoration-none" href="/">Home</a>
                </nav>
            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">

            </div>
        </header>

        <main>

            <h2 class="display-6 text-center mb-4">Enrolments</h2>
            <div class="d-flex justify-content-end mb-2">

                <form class="d-flex col-3">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= $search ?>">
                    <input class="form-control me-2" type="hidden" name="page" placeholder="Search" aria-label="Search" value="1">
                </form>
            </div>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th >First Name</th>
                            <th >Surname</th>
                            <th >Course Name</th>
                            <th >Course Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $key => $result) { ?>
                            <tr>
                                <td><?= $result['firstname'] ?></td>
                                <td><?= $result['surname'] ?></td>
                                <td><?= $result['description'] ?></td>
                                <td><span class="badge <?= getStatusBadgeColor($result['status']) ?>"><?= $result['status'] ?></span></td>
                            </tr>

                        <?php } ?>

                        <?php if (count($results) == 0) {  ?>
                            <tr>
                                <td colspan="4" class="text-center">No rows found</td>
                            </tr>
                        <?php } ?>
                    </tbody>


                </table>
            </div>
            <?= createPaginationHtml($count, $per_page, $current_page) ?>
        </main>
    </div>
</body>

</html>