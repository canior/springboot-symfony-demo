package com.snazzy.crm.controller;

import com.snazzy.crm.dto.AccountSearch;
import com.snazzy.crm.model.Account;
import com.snazzy.crm.repository.AccountRepository;
import com.snazzy.crm.service.SearchService;
import lombok.AllArgsConstructor;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import javax.validation.Valid;
import java.util.List;

@RestController
@AllArgsConstructor
public class AccountController {
    private final AccountRepository accountRepository;

    private final SearchService searchService;

    @GetMapping("/account")
    public List<Account> search(@Valid final AccountSearch accountSearch) {
        return this.searchService.search(accountSearch, this.accountRepository);
    }
}
