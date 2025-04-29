

<section class="section">
    <div class="container">
        <h1>History Login (Session Version)</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Waktu Login</th>
                </tr>
            </thead>
            <tbody>
                    <?php if (isset($logins) && !empty($logins)): ?>
                        <?php foreach ($logins as $login): ?>
                            <tr>
                                <td><?= esc($login['username']) ?></td>
                                <td><?= esc($login['role']) ?></td>
                                <td><?= esc($login['login_time']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data login.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

        </table>
    </div>
</section>


