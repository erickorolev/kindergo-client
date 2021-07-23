<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Domains\Attendants\Models{
/**
 * Domains\Attendants\Models\Attendant
 *
 * @property int $id
 * @property string $firstname Имя
 * @property string $lastname Фамилия
 * @property string|null $middle_name Отчество
 * @property \Parents\ValueObjects\PhoneNumberValueObject|null $phone Телефон
 * @property string $resume Анкета
 * @property string $car_model Марка автомобиля
 * @property string $car_year Год автомобиля
 * @property string|null $imagename Фотография
 * @property \Parents\ValueObjects\EmailValueObject|null|null $email Адрес электронной почты
 * @property \Parents\Enums\GenderEnum $gender Пол
 * @property \Parents\ValueObjects\CrmIdValueObject|null|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Media|null $avatar
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Trips\Models\Trip[] $trips
 * @property-read int|null $trips_count
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereCarModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereCarYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereImagename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereUpdatedAt($value)
 */
	final class Attendant extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace Domains\Authorization\Models{
/**
 * Domains\Authorization\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Users\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	final class Permission extends \Eloquent {}
}

namespace Domains\Authorization\Models{
/**
 * Domains\Authorization\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Users\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	final class Role extends \Eloquent {}
}

namespace Domains\Children\Models{
/**
 * Domains\Children\Models\Child
 *
 * @property int $id
 * @property string $firstname Имя
 * @property string $lastname Фамилия
 * @property string|null $middle_name Отчество
 * @property \Illuminate\Support\Carbon $birthday Дата рождения
 * @property \Parents\Enums\GenderEnum $gender Пол
 * @property \Parents\ValueObjects\PhoneNumberValueObject|null $phone Телефон
 * @property string|null $imagename Фотография
 * @property \Parents\ValueObjects\PhoneNumberValueObject|null|null $otherphone Другой телефон
 * @property \Parents\ValueObjects\CrmIdValueObject|null|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Media|null $avatar
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Timetables\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Trips\Models\Trip[] $trips
 * @property-read int|null $trips_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Users\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Child newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Child newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Child query()
 * @method static \Illuminate\Database\Eloquent\Builder|Child search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Child searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereImagename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereOtherphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Child whereUpdatedAt($value)
 */
	final class Child extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace Domains\Payments\Models{
/**
 * Domains\Payments\Models\Payment
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $pay_date Дата платежа
 * @property \Domains\Payments\Enums\TypePaymentEnum $type_payment Вид оплаты
 * @property \Parents\ValueObjects\MoneyValueObject|null $amount Сумма в копейках
 * @property \Domains\Payments\Enums\SpStatusEnum $spstatus Статус
 * @property int $user_id Контакт
 * @property \Parents\ValueObjects\CrmIdValueObject|null|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Domains\Users\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSpstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTypePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */
	final class Payment extends \Eloquent {}
}

namespace Domains\TemporaryFile\Models{
/**
 * Domains\TemporaryFile\Models\TemporaryFile
 *
 * @property int $id
 * @property string $folder
 * @property string $filename
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereFolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereUpdatedAt($value)
 */
	final class TemporaryFile extends \Eloquent {}
}

namespace Domains\Timetables\Models{
/**
 * Domains\Timetables\Models\Timetable
 *
 * @property int $id
 * @property string $name Откуда
 * @property string $where_address Куда
 * @property \Illuminate\Database\Eloquent\Collection|\Domains\Trips\Models\Trip[] $trips Количество поездок
 * @property int $childrens Количество детей
 * @property string $childrens_age Возраст детей
 * @property \Illuminate\Support\Carbon $date Дата отправления
 * @property \Parents\ValueObjects\TimeValueObject|null $time Время отправления
 * @property int $duration Длительность маршрута в минутах
 * @property float $distance Дистанция маршрута в км
 * @property int $scheduled_wait_from Запланированное ожидание в точке Откуда в минутах
 * @property int $scheduled_wait_where Запланированное ожидание в точке Куда в минутах
 * @property \Domains\Timetables\Enums\TimetableStatusEnum $status Статус
 * @property bool $bill_paid Оплачен ли счёт
 * @property string $description Описание
 * @property string $parking_info Информация о парковке
 * @property int|null $user_id Контакт
 * @property \Parents\ValueObjects\CrmIdValueObject|null|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Children\Models\Child[] $children
 * @property-read int|null $children_count
 * @property-read int|null $trips_count
 * @property-read \Domains\Users\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereBillPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereChildrens($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereChildrensAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereParkingInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereScheduledWaitFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereScheduledWaitWhere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereTrips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereWhereAddress($value)
 */
	final class Timetable extends \Eloquent {}
}

namespace Domains\Trips\Models{
/**
 * Domains\Trips\Models\Trip
 *
 * @property int $id
 * @property string $name Откуда
 * @property string $where_address Куда
 * @property \Illuminate\Support\Carbon $date Дата отправления
 * @property \Parents\ValueObjects\TimeValueObject|null $time Время отправления
 * @property int $childrens Количество детей
 * @property \Domains\Trips\Enums\TripStatusEnum $status Статус
 * @property int|null $attendant_id Сопровождающий
 * @property int|null $user_id Клиент
 * @property int $timetable_id Расписание
 * @property int $scheduled_wait_where Незапланированное время ожидания в точке Куда
 * @property int $scheduled_wait_from Незапланированное время ожидания в точке Откуда
 * @property \Parents\ValueObjects\MoneyValueObject|null $parking_cost Стоимость парковки
 * @property \Parents\ValueObjects\CrmIdValueObject|null|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Domains\Attendants\Models\Attendant|null $attendant
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Children\Models\Child[] $children
 * @property-read int|null $children_count
 * @property-read \Domains\Timetables\Models\Timetable $timetable
 * @property-read \Domains\Users\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereAttendantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereChildrens($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereParkingCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereScheduledWaitFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereScheduledWaitWhere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereTimetableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereWhereAddress($value)
 */
	final class Trip extends \Eloquent {}
}

namespace Domains\Users\Models{
/**
 * Domains\Users\Models\User
 *
 * @property int $id
 * @property \Domains\Users\ValueObjects\FullNameValueObject $name Отображаемое имя контакта
 * @property string $email Адрес электронной почты
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property int|null $current_team_id
 * @property string|null $imagename Фотография
 * @property string|null $profile_photo_path Фотография Профиля
 * @property string $firstname Имя
 * @property string $lastname Фамилия
 * @property string|null $middle_name Отчество
 * @property \Parents\ValueObjects\PhoneNumberValueObject|null $phone Телефон
 * @property \Domains\Users\Enums\AttendantGenderEnum $attendant_gender Предпочитаемый пол сопровождающего
 * @property \Parents\ValueObjects\PhoneNumberValueObject|null|null $otherphone Другой телефон
 * @property \Parents\ValueObjects\CrmIdValueObject|null|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Children\Models\Child[] $children
 * @property-read int|null $children_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Media|null $avatar
 * @property-read string $profile_photo_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Payments\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Timetables\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Domains\Users\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|User searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAttendantGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImagename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOtherphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	final class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

