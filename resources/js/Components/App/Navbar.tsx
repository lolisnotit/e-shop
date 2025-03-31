import { Link, usePage } from '@inertiajs/react'
import React from 'react'

function Navbar() {
    const { auth } = usePage().props;
    const { user } = auth;
    return (
        <div>
            <div className="navbar bg-base-100 shadow-sm">
                <div className="flex-1">
                    <Link href='/' className="btn btn-ghost text-xl">e-shop</Link>
                </div>
                <div className="flex gap-4">
                    <div className="dropdown dropdown-end">
                        <div tabIndex={0} role="button" className="btn btn-ghost btn-circle">
                            <div className="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /> </svg>
                                <span className="badge badge-sm indicator-item">8</span>
                            </div>
                        </div>
                        <div
                            tabIndex={0}
                            className="card card-compact dropdown-content bg-base-100 z-1 mt-3 w-52 shadow">
                            <div className="card-body">
                                <span className="text-lg font-bold">8 個の商品</span>
                                <span className="text-info">小計: 999円</span>
                                <div className="card-actions">
                                    <button className="btn btn-primary btn-block">ショッピングカート</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {user && <div className="dropdown dropdown-end">
                        <div tabIndex={0} role="button" className="btn btn-ghost btn-circle avatar">
                            <div className="avatar avatar-placeholder">
                                <div className="bg-neutral text-neutral-content w-8 rounded-full">
                                    <span className="text-3xl">AI</span>
                                </div>
                            </div>
                        </div>
                        <ul
                            tabIndex={0}
                            className="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                            <li>
                                <Link href={route('profile.edit')} className="justify-between">
                                    プロフィール
                                    <span className="badge">New</span>
                                </Link>
                            </li>
                            <li><Link href={route('logout')}>設定</Link></li>
                            <li><Link href={route('logout')} method={"post"} as='button'>ログアウト</Link></li>
                        </ul>
                    </div>}
                    {!user && <>
                        <Link href={route('login')} className={"btn"}>ログイン</Link>
                        <Link href={route('register')} className={"btn btn-primary"}>会員登録</Link>

                    </>}
                </div>
            </div>
        </div>
    )
}

export default Navbar