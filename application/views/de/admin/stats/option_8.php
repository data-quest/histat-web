
<table>
    <thead>
        <tr>
            <th width="20%">Nutzer</th>
            <th width="70%">Erläuterung</th>
            <th width="10%">Anzahl</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Registrierung</td>
            <td class="even">Registrierungen insgesamt (Zuteilung eines Passwortes).</td>
            <td> <?= $result1[0]->count ?></td>

        </tr>
        <tr>
            <td>Nutzer aus Forschungseinrichtungen</td>
            <td class="even">Registrierungen mit Angabe einer Institution im Adressfeld.</td>
            <td><?= $result2[0]->count ?></td>
        </tr>
        <tr>
            <td>Nutzer mit Angabe einer Privatadresse</td>
            <td class="even">Registrierungen ohne Angabe einer Institution im Adressfeld.</td>
            <td><?= $result3[0]->count ?></td>
        </tr>
    </tbody>
</table>


<table>
    <thead>
        <tr>
              <th  width="20%">Aufrufe</th>
              <th  width="70%">Erläuterung</th>
              <th  width="10%">Anzahl</th>
        </tr>
  
    </thead>
    <tbody>
        <tr>
            <td>Aufrufe insgesamt</td>
            <td class="even">Aufrufe der Datenbank (einschl. Registrierungen) insgesamt.</td>
            <td> <?= $result4[0]->count ?></td>
        </tr>
         <tr>
            <td>Aufrufe ohne Anmeldung (Login)</td>
            <td class="even">Aufrufe der Datenbank ohne Anmeldung.</td>
            <td> <?= $result5[0]->count ?></td>
        </tr>
         <tr>
            <td>Anmeldung (Login) mit Download</td>
            <td class="even">Aufrufe der Datenbank mit Download (gezählt werden die Anmeldungen, die mindestens zu einem Download geführt haben).</td>
            <td> <?= $result6[0]->count ?></td>
        </tr>
          <tr>
            <td>Anmeldung (Login) mit Download</td>
            <td class="even">Aufrufe der Datenbank mit Download von\nDatentabellen (gezählt werden die Datentabellen, die downgeloadet wurden).</td>
            <td> <?= $result7[0]->count ?></td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
              <th  width="20%">Downloads</th>
              <th  width="70%">Erläuterung</th>
              <th  width="10%">Anzahl</th>
        </tr>
  
    </thead>
    <tbody>
        <tr>
            <td>Zeitreihen aus Studien</td>
            <td class="even">Zeitreihen insgesamt innerhalb der Downloads.</td>
            <td> <?= $result8[0]->count ?></td>
        </tr>
         <tr>
            <td>Datentabellen aus Studien</td>
            <td class="even">Downloads insgesamt aus den verfügbaren Studien.</td>
            <td> <?= $result9[0]->count ?></td>
        </tr>
         <tr>
            <td>Nachgefragte Studien</td>
            <td class="even">Verschiedene Studien, aus denen Downloads erfolgten.</td>
            <td> <?= $result10[0]->count ?></td>
        </tr>

    </tbody>
</table>
