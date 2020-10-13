<table class="table">
        <tbody>
            <?php if(count($jobs) > 0 ){ ?>
                <?php foreach($jobs as $job){ ?>
                    <tr>
                        <td scope="row"><a href="{{ route('frontend.uradetails',$job->id ) }}"><?= $job->title ?></a></td>
                        <td><?= $job->department_name ?></td>
                        <td><?= $job->location ?></td>
                    </tr>
                <?php } ?>
            <?php }else{ ?>
                <tr>
                    <th scope="row" rowspan="3">Työtä ei löytynyt!</th>
                </tr>
                <?php } ?>
        </tbody>
</table>