<?php
/**
 * @copyright Copyright (c) 2014 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dejvidecz\google\maps\overlays;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\LatLngBounds;
use dosamigos\google\maps\ObjectAbstract;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\OverlayTrait;
use dosamigos\google\maps\Point;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;

/**
 * Marker
 *
 * Google maps marker. For information about the options available please visit:
 * https://developers.google.com/maps/documentation/javascript/reference?csw=1#MarkerOptions
 *
 * @property Point anchorPoint The offset from the marker's position to the tip of an InfoWindow that has been opened
 * with the marker as anchor.
 * @property string animation Which animation to play when marker is added to a map.
 * @property boolean clickable If true, the marker receives mouse and touch events. Default value is true.
 * @property boolean crossOnDrag If false, disables cross that appears beneath the marker when dragging. This option is
 * true by default.
 * @property string cursor Mouse cursor to show on hover
 * @property boolean draggable If true, the marker can be dragged. Default value is false.
 * @property string|Icon|Symbol icon Icon for the foreground. If a string is provided, it is treated as though it were
 * an Icon with the string as url.
 * @property string map Map on which to display Marker.
 * @property int opacity The marker's opacity between 0.0 and 1.0.
 * @property boolean optimized Optimization renders many markers as a single static element. Optimized rendering is
 * enabled by default. Disable optimized rendering for animated GIFs or PNGs, or when each marker must be rendered as a
 * separate DOM element (advanced usage only).
 * @property LatLng position Marker position. Required.
 * @property MarkerShape shape Image map region definition used for drag/click.
 * @property string title Rollover text
 * @property boolean visible If true, the marker is visible
 * @property int zIndex All markers are displayed on the map in order of their zIndex, with higher values displaying in
 * front of markers with lower values. By default, markers are displayed according to their vertical position on screen,
 * with lower markers appearing in front of markers further up the screen.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class MarkerCluster extends ObjectAbstract
{
    use OverlayTrait;

    /**
     * @var MarkerClusterMarker[]
     */
    public $markers=[];

    /**
     * @inheritdoc
     */
    public function init()
    {

    }

    /**
     * The constructor js code for the Marker object
     * @return string
     */
    public function getJs()
    {

        $js[] = "var markers = []";

        foreach ($this->markers as $marker) {
            $js[] = $marker->getJs();
        }

        $js[] = "var options = {
            gridSize: 10,
            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
        };";

        $js[] = "var {$this->getName()} = new MarkerClusterer({$this->map},markers,options);";


        return implode("\n", $js);
    }


    public function addMarker(MarkerClusterMarker $marker)
    {
        $this->markers[] = $marker;
    }


}