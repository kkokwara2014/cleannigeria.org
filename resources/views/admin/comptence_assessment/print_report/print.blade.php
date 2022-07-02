<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Competence Assessment Report</title>
</head>
<body>
   
        <div style="text-align: center">
            <img src="{{ asset('bootstrap_assets/images/LOGO.png') }}" width="70" height="70">
        </div>
    
        <div style="text-align: center">
            <h3>{{ $comptassuser->competenceassessment->title }} Report</h3>
            <h4>
                Staff Name: {{ $staff->firstname.' '.$staff->lastname }}
                &nbsp;
                &nbsp;
                Location: {{ $staff->location->name }}
            </h4>
        </div>
                    
        <table >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Required Competence</th>
                    <th>Self Assessment</th>
                    <th>Assessor Assessment</th>
                    <th>Evidence</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{  $hsworkenv->caption }}</td>
                    <td style="background-color: {{  $hsworkenv->legend->color }}">{{  $hsworkenv->legend->name }}</td>
                    <td style="background-color: {{  $hsworkenv->profiassebyassessor }}">{{  $hsworkenv->legend->name }}</td>
                    <td>{{  $hsworkenv->evidence }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>{{  $hsrisk->caption }}</td>
                    <td style="background-color: {{  $hsrisk->legend->color }}">{{  $hsrisk->legend->name }}</td>
                    <td style="background-color: {{  $hsrisk->profiassebyassessor }}">{{  $hsrisk->legend->name }}</td>
                    <td>{{  $hsrisk->evidence }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>{{  $hsriskmgt->caption }}</td>
                    <td style="background-color: {{  $hsriskmgt->legend->color }}">{{  $hsriskmgt->legend->name }}</td>
                    <td style="background-color: {{  $hsriskmgt->profiassebyassessor }}">{{  $hsriskmgt->legend->name }}</td>
                    <td>{{  $hsriskmgt->evidence }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>{{  $fatraining->caption }}</td>
                    <td style="background-color: {{  $fatraining->legend->color }}">{{  $fatraining->legend->name }}</td>
                    <td style="background-color: {{  $fatraining->profiassebyassessor }}">{{  $fatraining->legend->name }}</td>
                    <td>{{  $fatraining->evidence }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>{{  $gastesting->caption }}</td>
                    <td style="background-color: {{  $gastesting->legend->color }}">{{  $gastesting->legend->name }}</td>
                    <td style="background-color: {{  $gastesting->profiassebyassessor }}">{{  $gastesting->legend->name }}</td>
                    <td>{{  $gastesting->evidence }}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>{{  $ophandover->caption }}</td>
                    <td style="background-color: {{  $ophandover->legend->color }}">{{  $ophandover->legend->name }}</td>
                    <td style="background-color: {{  $ophandover->profiassebyassessor }}">{{  $ophandover->legend->name }}</td>
                    <td>{{  $ophandover->evidence }}</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>{{  $forkliftop->caption }}</td>
                    <td style="background-color: {{  $forkliftop->legend->color }}">{{  $forkliftop->legend->name }}</td>
                    <td style="background-color: {{  $forkliftop->profiassebyassessor }}">{{  $forkliftop->legend->name }}</td>
                    <td>{{  $forkliftop->evidence }}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>{{  $respequip->caption }}</td>
                    <td style="background-color: {{  $respequip->legend->color }}">{{  $respequip->legend->name }}</td>
                    <td style="background-color: {{  $respequip->profiassebyassessor }}">{{  $respequip->legend->name }}</td>
                    <td>{{  $respequip->evidence }}</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>{{  $miscresp->caption }}</td>
                    <td style="background-color: {{  $miscresp->legend->color }}">{{  $miscresp->legend->name }}</td>
                    <td style="background-color: {{  $miscresp->profiassebyassessor }}">{{  $miscresp->legend->name }}</td>
                    <td>{{  $miscresp->evidence }}</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>{{  $selfloader->caption }}</td>
                    <td style="background-color: {{  $selfloader->legend->color }}">{{  $selfloader->legend->name }}</td>
                    <td style="background-color: {{  $selfloader->profiassebyassessor }}">{{  $selfloader->legend->name }}</td>
                    <td>{{  $selfloader->evidence }}</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>{{  $pdriven->caption }}</td>
                    <td style="background-color: {{  $pdriven->legend->color }}">{{  $pdriven->legend->name }}</td>
                    <td style="background-color: {{  $pdriven->profiassebyassessor }}">{{  $pdriven->legend->name }}</td>
                    <td>{{  $pdriven->evidence }}</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>{{  $fateoilspill->caption }}</td>
                    <td style="background-color: {{  $fateoilspill->legend->color }}">{{  $fateoilspill->legend->name }}</td>
                    <td style="background-color: {{  $fateoilspill->profiassebyassessor }}">{{  $fateoilspill->legend->name }}</td>
                    <td>{{  $fateoilspill->evidence }}</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>{{  $impactoilpollu->caption }}</td>
                    <td style="background-color: {{  $impactoilpollu->legend->color }}">{{  $impactoilpollu->legend->name }}</td>
                    <td style="background-color: {{  $impactoilpollu->profiassebyassessor }}">{{  $impactoilpollu->legend->name }}</td>
                    <td>{{  $impactoilpollu->evidence }}</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>{{  $impactoilpollu->caption }}</td>
                    <td style="background-color: {{  $impactoilpollu->legend->color }}">{{  $impactoilpollu->legend->name }}</td>
                    <td style="background-color: {{  $impactoilpollu->profiassebyassessor }}">{{  $impactoilpollu->legend->name }}</td>
                    <td>{{  $impactoilpollu->evidence }}</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>{{  $survmodviz->caption }}</td>
                    <td style="background-color: {{  $survmodviz->legend->color }}">{{  $survmodviz->legend->name }}</td>
                    <td style="background-color: {{  $survmodviz->profiassebyassessor }}">{{  $survmodviz->legend->name }}</td>
                    <td>{{  $survmodviz->evidence }}</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>{{  $offshoreresp->caption }}</td>
                    <td style="background-color: {{  $offshoreresp->legend->color }}">{{  $offshoreresp->legend->name }}</td>
                    <td style="background-color: {{  $offshoreresp->profiassebyassessor }}">{{  $offshoreresp->legend->name }}</td>
                    <td>{{  $offshoreresp->evidence }}</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>{{  $dispers->caption }}</td>
                    <td style="background-color: {{  $dispers->legend->color }}">{{  $dispers->legend->name }}</td>
                    <td style="background-color: {{  $dispers->profiassebyassessor }}">{{  $dispers->legend->name }}</td>
                    <td>{{  $dispers->evidence }}</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>{{  $shorelineresp->caption }}</td>
                    <td style="background-color: {{  $shorelineresp->legend->color }}">{{  $shorelineresp->legend->name }}</td>
                    <td style="background-color: {{  $shorelineresp->profiassebyassessor }}">{{  $shorelineresp->legend->name }}</td>
                    <td>{{  $shorelineresp->evidence }}</td>
                </tr>
                <tr>
                    <td>19</td>
                    <td>{{  $inlandresp->caption }}</td>
                    <td style="background-color: {{  $inlandresp->legend->color }}">{{  $inlandresp->legend->name }}</td>
                    <td style="background-color: {{  $inlandresp->profiassebyassessor }}">{{  $inlandresp->legend->name }}</td>
                    <td>{{  $inlandresp->evidence }}</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>{{  $incidmgt->caption }}</td>
                    <td style="background-color: {{  $incidmgt->legend->color }}">{{  $incidmgt->legend->name }}</td>
                    <td style="background-color: {{  $incidmgt->profiassebyassessor }}">{{  $incidmgt->legend->name }}</td>
                    <td>{{  $incidmgt->evidence }}</td>
                </tr>
            </tbody>
        </table>
    
</body>
</html>