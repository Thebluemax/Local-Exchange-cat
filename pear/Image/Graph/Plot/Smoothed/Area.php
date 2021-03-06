<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Image_Graph - PEAR PHP OO Graph Rendering Utility.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This library is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version. This library is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser
 * General Public License for more details. You should have received a copy of
 * the GNU Lesser General Public License along with this library; if not, write
 * to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA
 * 02111-1307 USA
 *
 * @category   Images
 * @package    Image_Graph
 * @subpackage Plot
 * @author     Jesper Veggerby <pear.nosey@veggerby.dk>
 * @copyright  Copyright (C) 2003, 2004 Jesper Veggerby Hansen
 * @license    http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1
 * @version    CVS: $Id: Area.php,v 1.10 2005/08/03 21:21:52 nosey Exp $
 * @link       http://pear.php.net/package/Image_Graph
 */

/**
 * Include file Image/Graph/Plot/Smoothed/Bezier.php
 */
require_once 'Image/Graph/Plot/Smoothed/Bezier.php';

/**
 * Bezier smoothed area chart
 *
 * Similar to an {@link Image_Graph_Plot_Area}, but the interconnecting lines
 * between two datapoints are smoothed using a Bezier curve, which enables the
 * chart to appear as a nice curved plot instead of the sharp edges of a
 * conventional {@link Image_Graph_Plot_Area}. Smoothed charts are only supported
 * with non-stacked types
 *
 * @category   Images
 * @package    Image_Graph
 * @subpackage Plot
 * @author     Jesper Veggerby <pear.nosey@veggerby.dk>
 * @copyright  Copyright (C) 2003, 2004 Jesper Veggerby Hansen
 * @license    http://www.gnu                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ay(
                        	'x' => $cp['X'],
                        	'y' => $cp['Y'],
                        	'p1x' => $cp['P1X'],
                        	'p1y' => $cp['P1Y'],
                        	'p2x' => $cp['P2X'],
                        	'p2y' => $cp['P2Y']
                        )
                    );
                } else {
                    $x = $this->_pointX($p1);
                    $y = $this->_pointY($p1);
                    $this->_canvas->addVertex(array('x' => $x, 'y' => $y));
                }
                $lastPoint = $p1;
                $first = false;
            }
            $lastPoint['Y'] = '#min_pos#';
            $x = $this->_pointX($lastPoint);
            $y = $this->_pointY($lastPoint);
            $this->_canvas->addVertex(array('x' => $x, 'y' => $y));

            $this->_getFillStyle($key);
            $this->_getLineStyle($key);
            $this->_canvas->polygon(array('connect' => true));
        }
        unset($keys);
        $this->_drawMarker();
        $this->_canvas->endGroup();
        return true;
    }

}

?>