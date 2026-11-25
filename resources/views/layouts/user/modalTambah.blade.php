<div
    class="modal fade"
    id="modalTambah">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                action="{{ route('user.store') }}"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5>

                        Tambah User

                    </h5>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Nama</label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Username</label>

                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Password</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Konfirmasi Password</label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Role</label>

                        <select
                            name="role"
                            class="form-select">

                            <option value="ADMIN">

                                Administrator

                            </option>

                            <option value="KASIR">

                                Kasir

                            </option>

                            <option value="PEMILIK">

                                Pemilik

                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Status</label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="1">

                                Aktif

                            </option>

                            <option value="0">

                                Nonaktif

                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        type="button">

                        Batal

                    </button>

                    <button
                        class="btn btn-success">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>