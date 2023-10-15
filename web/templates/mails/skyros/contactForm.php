<table>
    <tr>
        <td><h3><?= $this->translate('form.placeholder.date') ?> : </h3> </td>
        <td><p><?= date("d-m-Y H:i:s") ?></p></td>
    </tr>
    <tr>
        <td><h3><?= mainModel::getLang("contact.form.name",$lang) ?> : </h3> </td>
        <td><p><?= $clean['name'] ?></p></td>
    </tr>

    <tr>
        <td><h3><?= mainModel::getLang("contact.form.subject",$lang) ?> : </h3> </td>
        <td><p><?= $clean['subject'] ?></p></td>
    </tr>

    <tr>

        <td><h3><?= mainModel::getLang("contact.form.email",$lang) ?> : </h3></td>
        <td><p><?= $clean['email'] ?></p></td>
    </tr>

    <tr>
        <td><h3><?= mainModel::getLang("contact.form.message",$lang) ?> : </h3> </td>
        <td><p><?= $clean['message'] ?></p></td>
    </tr>

</table>