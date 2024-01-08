package com.snazzy.crm.controller;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.snazzy.crm.CrmApplication;
import com.snazzy.crm.model.Account;
import com.snazzy.crm.repository.AccountRepository;
import com.snazzy.crm.service.SearchService;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.mockito.junit.jupiter.MockitoExtension;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.boot.test.json.JacksonTester;
import org.springframework.http.HttpStatus;
import org.springframework.mock.web.MockHttpServletResponse;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.setup.MockMvcBuilders;

import java.util.Arrays;
import java.util.List;

import static org.assertj.core.api.Assertions.assertThat;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.get;

@ExtendWith(MockitoExtension.class)
@SpringBootTest(classes = {CrmApplication.class})
public class AccountControllerTest {
    private MockMvc mvc;

    @Autowired
    private AccountRepository accountRepository;

    @Autowired
    private SearchService searchService;

    @Autowired
    private AccountController accountController;

    private JacksonTester<List<Account>> jsonAccounts;

    @BeforeEach
    public void setup() {
        JacksonTester.initFields(this, new ObjectMapper());
        mvc = MockMvcBuilders.standaloneSetup(accountController)
                .build();
    }

    @Test
    public void canRetrieveByIdWhenExists() throws Exception {
        MockHttpServletResponse response = mvc.perform(get("/account"))
                .andReturn().getResponse();

        assertThat(response.getStatus()).isEqualTo(HttpStatus.OK.value());
        assertThat(response.getContentAsString()).isEqualTo(
                jsonAccounts.write(Arrays.asList(
                        Account.builder().id(1).name("Good Burger").status("NEW").build(),
                        Account.builder().id(2).name("Acme Corp").status("NEW").build(),
                        Account.builder().id(3).name("Wonka Candy Company").status("NEW").build(),
                        Account.builder().id(4).name("Great Glass Elevator Corp").status("NEW").build()
                )).getJson()
        );
    }
}
