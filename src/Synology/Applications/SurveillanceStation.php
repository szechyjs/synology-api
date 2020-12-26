<?php
/**
 *
 * @author Ondrej Pospisil <https://github.com/pospon>
 * https://global.download.synology.com/download/Document/DeveloperGuide/Surveillance_Station_Web_API_v2.4.pdf
 */

namespace Synology\Applications;

use Synology\Api\Authenticate;
use Synology\Exception;
use Synology\Applications\SurveillanceStation\CardHolder;

class SurveillanceStation extends Authenticate
{

    const API_SERVICE_NAME = 'SurveillanceStation';
    const API_NAMESPACE = 'SYNO';

    private static $path = 'entry.cgi';

    /**
     * Info API setup
     *
     * @param string $address
     * @param int    $port
     * @param string $protocol
     * @param int    $version
     * @param bool   $verifySSL
     */
    public function __construct($address, $port = null, $protocol = null, $version = 1, $verifySSL = false)
    {
        parent::__construct(self::API_SERVICE_NAME, self::API_NAMESPACE, $address, $port, $protocol, $version, $verifySSL);
    }

    /**
     * @return array|bool|\stdClass
     * @throws Exception
     */
    public function getInfo()
    {
        return $this->_request('Info', static::$path, 'GetInfo');
    }

    /**
     * @return array|bool|\stdClass
     * @throws Exception
     */
    public function getCameraList()
    {
        return $this->_request('Camera', static::$path, 'List');
    }

    /**
     * @param $cameraId
     * @return array|bool|\stdClass
     * @throws Exception
     */
    public function getSnapshot($cameraId)
    {
        $parameters = [
            'cameraId' => $cameraId,
        ];
        return $this->_request('Camera', static::$path, 'GetSnapshot', $parameters);
    }

    /**
     * Get home mode related setting and information, including current binding
     * mobile devices if required.
     *
     * @param boolean $need_mobiles
     *   (optional) Home mode info will conclude which mobile devices is binding
     *   to the server, default to false.
     *
     * @return array|bool|\stdClass
     *   The home mode related setting and information.
     */
    public function getHomeModeInfo($need_mobiles = FALSE)
    {
        $parameters = [
            'need_mobiles' => $need_mobiles,
        ];
        return $this->_request('HomeMode', static::$path, 'GetInfo', $parameters, 1);
    }

    /**
     * Switch home mode on/off.
     *
     * @param boolean $on
     *   True to turn on home mode, while false to turn it off.
     *
     * @return array|bool|\stdClass
     *   This method has no specific response data. It returns an empty success
     *   response if it completes without error.
     */
    public function switchHomeMode($on)
    {
        $parameters = [
            'on' => $on,
        ];
        return $this->_request('HomeMode', static::$path, 'Switch', $parameters, 1);
    }

    /**
     * @param int $start
     * @param int $limit
     * @param string $filterKeyword
     * @param string $filterStatus
     * @param int $filterCtrlerId
     * @return array
     */
    public function enumCardHolder($start = null, $limit = null, $filterKeyword = null, $filterStatus = null, $filterCtrlerId = null)
    {
        $parameters = [
            'blGetSortInfo' => true,
            'sortInfo' => 'id,asc',
            'start' => 0,
            'limit' => 100
        ];

        if (isset($start)) {
            $parameters['start'] = $start;
        }
        if (isset($limit)) {
            $parameters['limit'] = $limit;
        }
        if (isset($filterKeyword)) {
            $parameters['filterKeyword'] = $filterKeyword;
        }
        if (isset($filterStatus)) {
            $parameters['filterStatus'] = $filterStatus;
        }
        if (isset($filterCtrlerId)) {
            $parameters['filterCtrlerId'] = $filterCtrlerId;
        }
        $res = $this->_request('AxisAcsCtrler', static::$path, 'EnumCardHolder', $parameters, 1);
        $cardHolders = array_map(array($this, 'dataToCardHolders'), $res->data);
        $res->data = $cardHolders;
        return $res;

    }

    /**
     * @param array|CardHolder
     */
    public function saveCardHolders($data)
    {
        $cardHolders = is_array($data) ? $data : [$data];

        $parameters = [
            'arrayJson' => '"' . addslashes(json_encode($cardHolders)) . '"'
        ];
        return $this->_request('AxisAcsCtrler', static::$path, 'SaveCardHolder', $parameters, 1, 'post');
    }

    /**
     * @param array|CardHolder
     */
    public function addCardHolders($data)
    {
        $cardHolders = is_array($data) ? $data : [$data];

        $parameters = [
            'arrayJson' => '"' . addslashes(json_encode($cardHolders)) . '"'
        ];

        return $this->_request('AxisAcsCtrler', static::$path, 'AddCardHolder', $parameters, 1, 'post');
    }

    private function dataToCardHolders($data)
    {
        return new CardHolder($data);
    }

}
