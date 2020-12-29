<?php

namespace Synology\Applications\SurveillanceStation;

class CardHolder implements \JsonSerializable {
    public $firstName; // string
    public $lastName; // string
    public $email; // string
    public $employNo; // string?
    public $description; // string?
    public $department; // string?
    public $extension; // 
    public $title; // string?
    public $pin; // int
    public $cardNum; //
    public $cardRaw; //
    public $facilityCode; // int?
    public $enableValidFrom; //
    public $validFrom; // int
    public $enableValidUntil; //
    public $validUntil; //int
    public $enableLongAccessTime = false;
    public $delPhoto = false;
    public $id; // int
    public $acsRuleIds; // int []?
    public $acsNameList = "";
    public $lastAccess; // int
    public $name; // string
    public $photo;
    public $photoName = "";
    public $photoWidth = 0;
    public $photoHeight = 0;
    public $photoTimestamp = 0;
    public $blocked; //
    public $status; // int

    public function __construct($data)
    {
        $this->firstName = $data->first_name;
        $this->lastName = $data->last_name;
        $this->email = $data->email;
        $this->employNo = $data->employ_no;
        $this->description = $data->description;
        $this->department = $data->department;
        $this->extension = $data->extension;
        $this->title = $data->title;
        $this->facilityCode = $data->facility_code;
        $this->cardNum = $data->card_num;
        $this->cardRaw = $data->card_raw;
        $this->pin = $data->pin;
        $this->id = $data->id;
        $this->status = $data->status;
        $this->blocked = $data->blocked;
        $this->name = $data->name;
        $this->lastAccess = $data->last_access;
        $this->enableLongAccessTime = $data->enable_long_access_time;
        $this->enableValidFrom = $data->enable_valid_from;
        $this->enableValidUntil = $data->enable_valid_until;
        $this->validUntil = $data->valid_until;
        $this->validFrom = $data->valid_from;
    }

    public function jsonSerialize() {
        $json = [
            'acsrule_ids' => $this->acsRuleIds,
            'acsrule_name_list' => $this->acsNameList,
            'blocked' => $this->blocked,
            'card_num' => $this->cardNum,
            'card_raw' => $this->cardRaw,
            'del_photo' => $this->delPhoto,
            'department' => $this->department,
            'description' => $this->description,
            'email' => $this->email,
            'employ_no' => $this->employNo,
            'enable_long_access_time' => $this->enableLongAccessTime,
            'enable_valid_from' => $this->enableValidFrom,
            'enable_valid_until' => $this->enableValidUntil,
            'extension' => $this->extension,
            'facility_code' => $this->facilityCode,
            'first_name' => $this->firstName,
            'grp_id' => 0, // todo
            'id' => $this->id,
            'last_access' => 0, // todo
            'last_name' => $this->lastName,
            'name' => $this->name,
            'photo_height' => $this->photoHeight,
            'photo_name' => $this->photoName,
            'photo_tmstmp' => $this->photoTimestamp,
            'photo_width' => $this->photoWidth,
            'pin' => $this->pin,
            'status' => $this->status,
            'title' => $this->title,
            'valid_from' => $this->validFrom,
            'valid_until' => $this->validUntil
        ];

        if (isset($photo)) {
            $json['photo'] = $photo;
        }
        return $json;
    }
}
