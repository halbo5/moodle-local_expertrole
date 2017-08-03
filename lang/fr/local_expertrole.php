<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Local plugin "Expert Role"
 *
 * @package    local_expertrole
 * @copyright  2017 Alain Bolli, <alain.bolli@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Rôle Expert';
$string['setting_completeinterface'] = 'Choix de l\'interface';
$string['setting_rolesimple'] = "Rôle avec l'interface simple";
$string['setting_rolesimple_desc'] = "Rôle avec l'interface simple : par exemple le rôle de l'enseignant éditeur pour lequel on a retiré quelques capacités (enlever quelques 'addinstance')";
$string['setting_rolecomplete'] = "Rôle avec l'interface complète";
$string['setting_rolecomplete_desc'] = "Rôle avec l'interface complète : cela peut être un rôle très simple avec uniquement les capacités enlevées au rôle simple";
$string['chooserole'] = "Choisir un rôle";
$string['interface'] = "Choix de l'interface";
$string['enablecompleteinterface'] = 'Activer l\'interface complète';
$string['configenablecompleteinterface'] = "Par défaut, votre interface est limitée pour rendre l'usage de Moodle plus simple (mois d'activités disponibles). Vous pouvez activer l'interface complète avec toutes les activités, mais Moodle sera un peu plus complexe à utiliser.";
$string['eventinterfaceupdated'] = "Interface modifiée";
$string['interfacetitle'] = 'Rôle expert';