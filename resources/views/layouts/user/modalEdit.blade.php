<div
    class="modal fade"
    id="modalEdit"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                id="formEdit"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">

                        Edit User

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Nama</label>

                        <input
                            type="text"
                            id="editNama"
                            name="nama"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Username</label>

                        <input
                            type="text"
                            id="editUsername"
                            name="username"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Password Baru</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control">

                        <small class="text-muted">

                            Kosongkan jika tidak ingin mengganti password.

                        </small>

                    </div>

                    <div class="mb-3">

                        <label>Role</label>

                        <select
                            id="editRole"
                            name="role"
                            class="form-select">

                            <option value="ADMIN">

                                Administrator

                            </option>

                            <option value="KASIR">

                                Kasir

                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Status</label>

                        <select
                            id="editStatus"
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
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        class="btn btn-success">

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>