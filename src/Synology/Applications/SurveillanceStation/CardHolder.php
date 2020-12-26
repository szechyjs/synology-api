<?php

namespace Synology\Applications\SurveillanceStation;

class CardHolder implements \JsonSerializable {
    private $firstName; // string
    private $lastName; // string
    private $email; // string
    private $employNo; // string?
    private $description; // string?
    private $department; // string?
    private $extension; // 
    private $title; // string?
    private $pin; // int
    private $cardNum; //
    private $cardRaw; //
    private $facilityCode; // int?
    private $enableValidFrom; //
    private $validFrom; // int
    private $enableValidUntil; //
    private $validUntil; //int
    private $enableLongAccessTime = false;
    private $delPhoto = false;
    private $id; // int
    private $acsRuleIds; // int []?
    private $acsNameList = "";
    private $lastAccess; // int
    private $name; // string
    private $photo;
    private $photoName = "";
    private $photoWidth = 0;
    private $photoHeight = 0;
    private $photoTimestamp = 0;
    private $blocked; //
    private $status; // int

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

    public function getFirstName() {
        return $this->firstName;
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
