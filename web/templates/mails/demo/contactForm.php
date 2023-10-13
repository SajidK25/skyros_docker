<table>
    <tr>
        <td><h3><?= $this->translate('form.placeholder.date') ?> : </h3> </td>
        <td><p><?= date("d-m-Y H:i:s") ?></p></td>
    </tr>
    <tr>
        <td><h3><?= $this->translate('form.placeholder.fullName')?> : </h3> </td>
        <td><p><?= $clean['fullName'] ?></p></td>
    </tr>

    <tr>
        <td><h3><?= $this->translate('form.placeholder.phone') ?> : </h3> </td>
        <td><p><?= $clean['phone'] ?></p></td>
    </tr>

    <tr>

        <td><h3><?= $this->translate('form.placeholder.email') ?> : </h3></td>
        <td><p><?= $clean['email'] ?></p></td>
    </tr>

    <tr>
        <td><h3><?= $this->translate('form.placeholder.message') ?> : </h3> </td>
        <td><p><?= $clean['message'] ?></p></td>
    </tr>

</table>